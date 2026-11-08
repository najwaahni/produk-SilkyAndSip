import urllib.request, urllib.parse, json

headers = {'User-Agent': 'Mozilla/5.0'}

def search_wiki(q):
    url = f"https://commons.wikimedia.org/w/api.php?action=query&list=search&srsearch={urllib.parse.quote(q)}&srnamespace=6&srlimit=8&format=json"
    req = urllib.request.Request(url, headers=headers)
    data = json.loads(urllib.request.urlopen(req, timeout=10).read().decode('utf-8'))
    for r in data.get('query', {}).get('search', []):
        title = r['title']
        info_url = f"https://commons.wikimedia.org/w/api.php?action=query&titles={urllib.parse.quote(title)}&prop=imageinfo&iiprop=url|size&format=json"
        try:
            pdata = json.loads(urllib.request.urlopen(urllib.request.Request(info_url, headers=headers), timeout=10).read().decode('utf-8'))
            for pid, p in pdata.get('query', {}).get('pages', {}).items():
                ii = p.get('imageinfo', [{}])[0]
                w, h = ii.get('width', 0), ii.get('height', 0)
                if w >= 800:
                    print(f"[{q}] {title} ({w}x{h}) -> {ii.get('url')}")
        except Exception:
            pass

search_wiki("purin coffee")
search_wiki("caramel pudding coffee")
search_wiki("flan cafe table")

