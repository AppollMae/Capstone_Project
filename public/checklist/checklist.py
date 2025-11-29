import sys
import json
import cv2
import easyocr
import numpy as np

if len(sys.argv) < 2:
    print(json.dumps({"error": "No image file provided"}))
    sys.exit(1)

image_path = sys.argv[1]

# Load image
image = cv2.imread(image_path)
if image is None:
    print(json.dumps({"error": "Invalid image path"}))
    sys.exit(1)

gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
blur = cv2.GaussianBlur(gray, (5, 5), 0)
_, thresh = cv2.threshold(blur, 150, 255, cv2.THRESH_BINARY_INV)

# Find contours (possible checkboxes)
contours, _ = cv2.findContours(thresh, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

check_regions = []
for c in contours:
    x, y, w, h = cv2.boundingRect(c)
    aspect_ratio = w / float(h)
    if 15 < w < 60 and 15 < h < 60 and 0.8 < aspect_ratio < 1.2:
        check_regions.append((x, y, w, h))

# Sort top to bottom
check_regions = sorted(check_regions, key=lambda x: x[1])

# Initialize OCR reader
reader = easyocr.Reader(['en'], gpu=False)

checked_items = []
unchecked_items = []

# Scan each checkbox region
for (x, y, w, h) in check_regions:
    roi = thresh[y:y+h, x:x+w]
    fill_ratio = cv2.countNonZero(roi) / (w * h)
    is_checked = fill_ratio > 0.2  # If 20% of box is filled, it's considered checked

    # Read nearby text to associate the checkbox
    text_region = gray[y:y+40, x+60:x+500]
    ocr_result = reader.readtext(text_region, detail=0)
    text_label = " ".join(ocr_result).strip().lower()

    if text_label:
        if is_checked:
            checked_items.append(text_label)
        else:
            unchecked_items.append(text_label)

output = {
    "checked": checked_items,
    "unchecked": unchecked_items
}

print(json.dumps(output))
