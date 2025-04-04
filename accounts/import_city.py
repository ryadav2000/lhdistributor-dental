import os
import pandas as pd
from django.conf import settings
from accounts.models import State

def import_city_lh():
    file_path = os.path.join(settings.BASE_DIR, "accounts", "lh_city_list.xlsx") # Absolute path

    if not os.path.exists(file_path): # Read the Excel file
        print(f"Error: File not found at {file_path}")
        return 
    
    df = pd.read_excel(file_path)

    for _, row in df.iterrows():
        State.objects.update_or_create(
            name=row['state']
        )

    print("✅ State data imported successfully!")


# Run the function
import_city_lh()


# Run After Uploading on live server

# python manage.py shell
# from orders.import_tax import import_tax_from_excel
# import_city_lh()