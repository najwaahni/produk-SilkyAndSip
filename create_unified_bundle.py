import os
from PIL import Image

# Paths
base_dir = os.path.abspath(os.path.dirname(__file__))
source_path = os.path.join(base_dir, 'public', 'images', 'cand_bundle2.jpg')
output_path = os.path.join(base_dir, 'public', 'images', 'bundle_duo.jpg')

bundle_photo = Image.open(source_path).convert('RGB')
bundle_photo.save(output_path, 'JPEG', quality=92, optimize=True)
print('Unified bundle image saved to', output_path)

