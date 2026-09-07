#!/usr/bin/env python3
"""
Script de Deploy Automático do Tema ATA Premium para a HostGator
Sincroniza arquivos locais com o servidor via FTP com suporte a TLS.
"""

import os
import sys
import ftplib
import configparser
from pathlib import Path

# Configurações padrão
DEFAULT_CONFIG = {
    'FTP_HOST': 'ftp.deven.com.br',
    'FTP_USER': 'lunyer90',
    'FTP_PASS': '',
    'FTP_PORT': '21',
    'REMOTE_PATH': '/atapremium.deven.com.br/wp-content/themes/atapremium'
}

CONFIG_FILE = '.env.deploy'

# Arquivos e pastas a ignorar no upload
EXCLUDE_DIRS = {'.git', '.github', 'docs', '.idea', '.vscode', '__pycache__', 'node_modules'}
EXCLUDE_FILES = {'.DS_Store', '.gitignore', '.env.deploy', 'deploy.py', 'deploy.sh', '.cpanel.yml'}
EXCLUDE_EXTENSIONS = {'.swp', '.tmp', '.bak'}

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

def create_default_config_if_missing():
    if not os.path.exists(CONFIG_FILE):
        with open(CONFIG_FILE, 'w') as f:
            f.write("# Configurações de Deploy HostGator\n")
            f.write("FTP_HOST=ftp.deven.com.br\n")
            f.write("FTP_USER=lunyer90\n")
            f.write("FTP_PASS=SUA_SENHA_AQUI\n")
            f.write("FTP_PORT=21\n")
            f.write("REMOTE_PATH=/atapremium.deven.com.br/wp-content/themes/atapremium\n")
        print(f"⚠️  Arquivo '{CONFIG_FILE}' criado. Configure sua senha no arquivo antes de continuar.")

def ensure_remote_dir(ftp, remote_dir):
    parts = remote_dir.strip('/').split('/')
    current = ''
    for part in parts:
        current += '/' + part
        try:
            ftp.cwd(current)
        except ftplib.error_perm:
            try:
                ftp.mkd(current)
                ftp.cwd(current)
            except Exception as e:
                pass

def upload_theme(config):
    host = config['FTP_HOST']
    user = config['FTP_USER']
    password = config['FTP_PASS']
    port = int(config.get('FTP_PORT', 21))
    remote_base = config['REMOTE_PATH'].rstrip('/')

    if not password or password == 'SUA_SENHA_AQUI':
        print(f"❌ Erro: Por favor, preencha a 'FTP_PASS' no arquivo '{CONFIG_FILE}' antes de executar o deploy.")
        sys.exit(1)

    print(f"🚀 Conectando a {host}:{port} como '{user}'...")
    try:
        ftp = ftplib.FTP_TLS()
        ftp.connect(host, port, timeout=30)
        ftp.login(user, password)
        ftp.prot_p() # Força canal de dados seguro TLS
        print("✅ Conectado com sucesso via FTP Seguro (TLS)!")
    except Exception as e:
        print(f"⚠️  Tentativa TLS falhou ({e}), tentando FTP padrão...")
        try:
            ftp = ftplib.FTP()
            ftp.connect(host, port, timeout=30)
            ftp.login(user, password)
            print("✅ Conectado com sucesso via FTP padrão!")
        except Exception as e2:
            print(f"❌ Falha crítica de conexão: {e2}")
            sys.exit(1)

    local_root = Path(__file__).resolve().parent
    print(f"📦 Enviando arquivos de: {local_root}")
    print(f"🎯 Destino no servidor: {remote_base}")
    print("-" * 50)

    uploaded_count = 0

    for root, dirs, files in os.walk(local_root):
        # Filtra diretórios
        dirs[:] = [d for d in dirs if d not in EXCLUDE_DIRS]

        rel_dir = os.path.relpath(root, local_root)
        if rel_dir == '.':
            target_remote_dir = remote_base
        else:
            target_remote_dir = f"{remote_base}/{rel_dir.replace(os.sep, '/')}"

        ensure_remote_dir(ftp, target_remote_dir)

        for filename in files:
            if filename in EXCLUDE_FILES:
                continue
            if any(filename.endswith(ext) for ext in EXCLUDE_EXTENSIONS):
                continue

            local_file = os.path.join(root, filename)
            rel_file_path = os.path.relpath(local_file, local_root)

            try:
                with open(local_file, 'rb') as f:
                    ftp.storbinary(f'STOR {filename}', f)
                uploaded_count += 1
                print(f"  ✓ {rel_file_path}")
            except Exception as err:
                print(f"  ✗ Erro ao enviar {rel_file_path}: {err}")

    ftp.quit()
    print("-" * 50)
    print(f"🎉 Deploy concluído com sucesso! {uploaded_count} arquivos sincronizados.")

if __name__ == '__main__':
    create_default_config_if_missing()
    cfg = load_config()
    upload_theme(cfg)
