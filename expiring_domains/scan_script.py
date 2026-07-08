#!/usr/bin/env python3
"""
Scan complet de tous les domaines .se des fichiers SEMrush.
Vérifie si des domaines sont expirés via WHOIS.
"""

import csv
import subprocess
import time
from pathlib import Path
import glob

# Dossier avec les CSV
FX_DIR = "/Users/harrar/Sites/hkmweb/projets/raknalon/fx"

def extract_all_se_domains():
    """Extraire tous les domaines .se uniques de tous les CSV."""
    domains = set()
    csv_files = glob.glob(f"{FX_DIR}/*.csv")
    
    print(f"Fichiers CSV trouvés: {len(csv_files)}")
    
    for csv_file in csv_files:
        try:
            with open(csv_file, 'r', encoding='utf-8', errors='ignore') as f:
                reader = csv.reader(f)
                next(reader, None)  # Skip header
                for row in reader:
                    if len(row) > 3:
                        domain = row[3].strip().lower()
                        # Filtrer uniquement les .se
                        if domain.endswith('.se') and len(domain) > 4:
                            # Exclure les géants
                            exclude = ['facebook', 'google', 'youtube', 'instagram', 
                                       'twitter', 'linkedin', 'wikipedia', 'microsoft']
                            if not any(x in domain for x in exclude):
                                domains.add(domain)
        except Exception as e:
            print(f"  Erreur lecture {csv_file}: {e}")
    
    return sorted(domains)

def check_domain_whois(domain):
    """Vérifier si un domaine est expiré via WHOIS."""
    try:
        result = subprocess.run(
            ['whois', domain],
            capture_output=True,
            text=True,
            timeout=8
        )
        output = result.stdout.lower()
        
        # Indicateurs de domaine disponible/expiré
        if any(x in output for x in ['not found', 'no match', 'available', 'no entries']):
            return 'EXPIRÉ'
        elif any(x in output for x in ['status', 'registrant', 'created', 'holder']):
            return 'actif'
        else:
            return 'inconnu'
    except subprocess.TimeoutExpired:
        return 'timeout'
    except Exception as e:
        return 'erreur'

def main():
    print("="*70)
    print("SCAN COMPLET - Domaines .se des fichiers SEMrush")
    print("="*70)
    
    domains = extract_all_se_domains()
    print(f"\n🔍 Domaines .se uniques trouvés: {len(domains)}")
    
    expired = []
    
    print(f"\nScan WHOIS de {len(domains)} domaines...")
    print("-"*70)
    
    for i, domain in enumerate(domains, 1):
        status = check_domain_whois(domain)
        
        if status == 'EXPIRÉ':
            print(f"[{i:3d}/{len(domains)}] 🔴 {domain:45s} → EXPIRÉ!")
            expired.append(domain)
        else:
            print(f"[{i:3d}/{len(domains)}] ✓  {domain:45s} → {status}")
        
        time.sleep(0.3)  # Rate limiting
    
    print("\n" + "="*70)
    print("RÉSULTATS FINAUX")
    print("="*70)
    print(f"\n📊 Total scanné: {len(domains)} domaines")
    print(f"🔴 Expirés/Disponibles: {len(expired)}")
    
    if expired:
        print("\n🎯 DOMAINES EXPIRÉS TROUVÉS:")
        for d in expired:
            print(f"   → {d}")
        
        # Sauvegarder
        with open(f"{FX_DIR}/expired_found.txt", 'w') as f:
            for d in expired:
                f.write(d + '\n')
        print(f"\n💾 Liste sauvegardée: {FX_DIR}/expired_found.txt")
    else:
        print("\n❌ Aucun domaine expiré trouvé dans cette liste.")

if __name__ == "__main__":
    main()
