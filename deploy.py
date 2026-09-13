#!/usr/bin/env python3
"""
Script de Deploy Automático do Tema ATA Premium para a HostGator
Sincronização inteligente via FTP (compara tamanhos para pular arquivos inalterados).
"""

import os
import sys
import ftplib
from pathlib import Path

# Configurações padrão
DEFAULT_CONFIG = {
    'FTP_HOST': 'ftp.deven.com.br',
    'FTP_USER': 'mark@atapremium.deven.com.br',
    'FTP_PASS': 'M@rk135791',
    'FTP_PORT': '21',
    'REMOTE_PATH': '/'
}

CONFIG_FILE = '.env.deploy'

# Arquivos e pastas a ignorar no upload
EXCLUDE_DIRS = {'.git', '.github', 'docs', '.idea', '.vscode', '__pycache__', 'node_modules', '.scratch', 'tmp'}
EXCLUDE_FILES = {
    '.DS_Store', '.gitignore', '.env.deploy', '.env.deploy.example', 
    'deploy.py', 'deploy.sh', '.cpanel.yml', 'README.md'
}
EXCLUDE_EXTENSIONS = {'.swp', '.tmp', '.bak', '.zip'}

def log(msg):
    print(msg, flush=True)

def load_config():
    config = DEFAULT_CONFIG.copy()
    if os.path.exists(CONFIG_FILE):
        with open(CONFIG_FILE, 'r') as f:
            for line in f:
                line = line.strip()
                if line and not line.startswith('#') and '=' in line:
                    k, v = line.split('=', 1)
                    config[k.strip()] = v.strip().strip('"').strip("'")
    return config

def ensure_remote_dir(ftp, remote_dir):
    clean_dir = remote_dir.strip('/')
    if not clean_dir:
        try:
            ftp.cwd('/')
        except Exception:
            pass
        return

    parts = [p for p in clean_dir.split('/') if p]
    current = ''
    for part in parts:
        current += '/' + part
        try:
            ftp.cwd(current)
        except ftplib.error_perm:
            try:
                ftp.mkd(current)
                ftp.cwd(current)
            except Exception:
                pass

def get_remote_file_size(ftp, filename):
    try:
        return ftp.size(filename)
    except Exception:
        return None

def upload_theme(config):
    host = config['FTP_HOST']
    user = config['FTP_USER']
    password = config['FTP_PASS']
    port = int(config.get('FTP_PORT', 21))
    remote_base = config.get('REMOTE_PATH', '/').strip('/')

    if not password or password == 'SUA_SENHA_AQUI':
        log(f"❌ Erro: Por favor, preencha a 'FTP_PASS' no arquivo '{CONFIG_FILE}' antes de executar o deploy.")
        sys.exit(1)

    log(f"🚀 Conectando a {host}:{port} como '{user}'...")
    ftp = None
    try:
        ftp = ftplib.FTP_TLS()
        ftp.connect(host, port, timeout=20)
        ftp.login(user, password)
        ftp.prot_p()
        log("✅ Conectado com sucesso via FTP Seguro (TLS)!")
    except Exception as e:
        log(f"⚠️  Tentativa TLS ({e}), conectando via FTP padrão...")
        try:
            ftp = ftplib.FTP()
            ftp.connect(host, port, timeout=20)
            ftp.login(user, password)
            log("✅ Conectado com sucesso via FTP padrão!")
        except Exception as e2:
            log(f"❌ Falha crítica de conexão: {e2}")
            sys.exit(1)

    local_root = Path(__file__).resolve().parent
    log(f"📦 Enviando arquivos de: {local_root}")
    log(f"🎯 Diretório base remoto: /{remote_base}")
    log("-" * 60)

    uploaded_count = 0
    skipped_count = 0

    for root, dirs, files in os.walk(local_root):
        dirs[:] = [d for d in dirs if d not in EXCLUDE_DIRS and not d.startswith('.')]

        rel_dir = os.path.relpath(root, local_root)
        if rel_dir == '.':
            target_remote_dir = f"/{remote_base}".rstrip('/') if remote_base else '/'
        else:
            rel_clean = rel_dir.replace(os.sep, '/').strip('/')
            target_remote_dir = f"/{remote_base}/{rel_clean}" if remote_base else f"/{rel_clean}"

        ensure_remote_dir(ftp, target_remote_dir)

        for filename in sorted(files):
            if filename in EXCLUDE_FILES or filename.startswith('.'):
                continue
            if any(filename.endswith(ext) for ext in EXCLUDE_EXTENSIONS):
                continue

            local_file = os.path.join(root, filename)
            rel_file_path = os.path.relpath(local_file, local_root)
            local_size = os.path.getsize(local_file)

            # Para arquivos grandes (vídeos/mídias), pula se já tiver exatamente o mesmo tamanho no servidor
            if filename.endswith(('.mp4', '.mov', '.avi', '.jpg', '.png', '.webp')) and local_size > 1024 * 500:
                remote_size = get_remote_file_size(ftp, filename)
                if remote_size is not None and remote_size == local_size:
                    skipped_count += 1
                    continue

            try:
                with open(local_file, 'rb') as f:
                    ftp.storbinary(f'STOR {filename}', f)
                try:
                    ftp.sendcmd(f'SITE CHMOD 644 {filename}')
                except Exception:
                    pass
                uploaded_count += 1
                log(f"  ✓ {rel_file_path} ({local_size:,} bytes)")
            except Exception as err:
                log(f"  ✗ Erro ao enviar {rel_file_path}: {err}")

    try:
        ftp.quit()
    except Exception:
        pass

    log("-" * 60)
    log(f"🎉 Deploy concluído com sucesso! {uploaded_count} arquivos atualizados ({skipped_count} mídias inalteradas ignoradas).")

if __name__ == '__main__':
    cfg = load_config()
    upload_theme(cfg)
