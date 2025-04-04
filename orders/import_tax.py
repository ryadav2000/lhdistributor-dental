import os
import pandas as pd
from django.conf import settings
from orders.models import Tax

def import_tax_from_excel():
    file_path = os.path.join(settings.BASE_DIR, "orders", "lh_tax_info.xlsx")  # Absolute path

    if not os.path.exists(file_path):
        print(f"Error: File not found at {file_path}")
        return

    df = pd.read_excel(file_path)  # Read the Excel file
    
    for _, row in df.iterrows():
        Tax.objects.update_or_create(
            city=row['city'], 
            zipcode=row['zipcode'],
            defaults={'tax': row['tax']}
        )

    print("✅ Tax data imported successfully!")

# Run the function
import_tax_from_excel()


# Run After Uploading on live server

# python manage.py shell
# from orders.import_tax import import_tax_from_excel
# import_tax_from_excel()