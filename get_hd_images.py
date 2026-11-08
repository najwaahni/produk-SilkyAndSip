import urllib.request
import urllib.parse
import re
import json
import os

headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
}

def search_ddg_images(query):
    try:
        token_url = 'https://duckduckgo.com/?q=' + urllib.parse.quote(query)
        req = urllib.request.Request(token_url, headers=headers)
        with urllib.request.urlopen(req, timeout=10) as resp:
            html = resp.read().decode('utf-8', errors='ignore')
        
        m = re.search(r'vqd=([0-9-]+)', html)
        if not m:
            m = re.search(r'vqd="([0-9-]+)"', html)
        if not m:
            return []
        vqd = m.group(1)
        
        img_url = f'https://duckduckgo.com/i.js?l=us-en&o=json&q={urllib.parse.quote(query)}&vqd={vqd}&f=,,,&p=1'
        req2 = urllib.request.Request(img_url, headers=headers)
        with urllib.request.urlopen(req2, timeout=10) as resp2:
            data = json.loads(resp2.read().decode('utf-8', errors='ignore'))
            return data.get('results', [])
    except Exception as e:
        print('Error searching:', query, e)
        return []

def download_image(url, output_path):
    try:
        req = urllib.request.Request(url, headers=headers)
        with urllib.request.urlopen(req, timeout=15) as resp:
            content = resp.read()
            if len(content) > 10000: # at least 10KB
                with open(output_path, 'wb') as f:
                    f.write(content)
                print(f'Successfully downloaded {output_path} ({len(content)} bytes)')
                return True
    except Exception as e:
        print(f'Failed to download {url}: {e}')
    return False

# 1. Silky Caramel Pudding
print('Searching Pudding...')
pudding_res = search_ddg_images('caramel pudding jar salted caramel food photography aesthetic')
for p in pudding_res[:5]:
    print('Pudding candidate:', p['title'], p['image'])
    if download_image(p['image'], 'public/images/hd_pudding.jpg'):
        break

# 2. Coffee Dalgona
print('Searching Dalgona...')
dalgona_res = search_ddg_images('dalgona coffee glass iced whipped foam cafe photography')
for d in dalgona_res[:5]:
    print('Dalgona candidate:', d['title'], d['image'])
    if download_image(d['image'], 'public/images/hd_dalgona.jpg'):
        break

# 3. Bundling / Combo
print('Searching Combo...')
combo_res = search_ddg_images('pudding and iced coffee table cafe aesthetic food photography')
for c in combo_res[:5]:
    print('Combo candidate:', c['title'], c['image'])
    if download_image(c['image'], 'public/images/hd_bundle.jpg'):
        break

print('DONE!')

