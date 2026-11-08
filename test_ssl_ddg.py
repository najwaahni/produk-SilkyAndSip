import urllib.request, urllib.parse, ssl, re

ctx = ssl._create_unverified_context()
headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}

url = "https://html.duckduckgo.com/html/?q=" + urllib.parse.quote('caramel pudding dalgona coffee jar cork aesthetic')
req = urllib.request.Request(url, headers=headers)
try:
    html = urllib.request.urlopen(req, context=ctx, timeout=10).read().decode('utf-8', errors='ignore')
    snippets = re.findall(r'<a class="result__snippet"[^>]*>(.*?)</a>', html, re.DOTALL)
    for s in snippets[:6]:
        clean = re.sub(r'<[^>]+>', '', s).strip()
        print("-", clean[:120])
except Exception as e:
    print(e)

