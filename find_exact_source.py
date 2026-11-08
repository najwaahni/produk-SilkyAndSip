import urllib.request, urllib.parse, json

headers = {'User-Agent': 'Mozilla/5.0'}

# Let's search DuckDuckGo html or Bing for exact image text
# What is the text on the sticker tag of the jar?
# Could it be from Lemon8, Xiaohongshu, Pinterest, or Canva?
# Let's search:
# "caramel pudding" "dalgona" site:pinterest.com
# "pudding" "dalgona" site:lemon8-app.com
url = "https://html.duckduckgo.com/html/?q=" + urllib.parse.quote('caramel pudding dalgona coffee jar cork site:pinterest.com OR site:lemon8-app.com OR site:canva.com')
try:
    req = urllib.request.Request(url, headers=headers)
    html = urllib.request.urlopen(req, timeout=10).read().decode('utf-8', errors='ignore')
    import re
    links = re.findall(r'<a class="result__url"[^>]*href="([^"]+)"', html)
    for l in links[:10]:
        print(l)
except Exception as e:
    print(e)

