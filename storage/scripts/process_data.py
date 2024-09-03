import pandas as pd
import sys
import json

def process_data(file_path):
    #utk baca dari eksel
    df = pd.read_excel(file_path, sheet_name='Sheet1', skiprows=5)



    #ganti nama kolom
    df.columns = [
        "ID", "Sektor", "Nilai_2019_SUMUT", "Nilai_2020_SUMUT", "Nilai_2021_SUMUT",
        "Nilai_2022_SUMUT", "Nilai_2023_SUMUT", "Nilai_2019_NIAS", "Nilai_2020_NIAS",
        "Nilai_2021_NIAS", "Nilai_2022_NIAS", "Nilai_2023_NIAS"
    ]

    #Ganti nilai non-numerik dengan NaN, lalu konversi ke numerik
    for col in df.columns[2:]: # Mulai dari kolom ketiga
        df[col] = pd.to_numeric(df[col], errors='coerce') # 'coerce' akan mengubah nilai non-numerik menjadi NaN

    #Hitung total untuk setiap tahun
    total_sumut = df[['Nilai_2019_SUMUT', 'Nilai_2020_SUMUT', 'Nilai_2021_SUMUT', 'Nilai_2022_SUMUT', 'Nilai_2023_SUMUT']].sum()
    total_nias = df[['Nilai_2019_NIAS', 'Nilai_2020_NIAS', 'Nilai_2021_NIAS', 'Nilai_2022_NIAS', 'Nilai_2023_NIAS']].sum()

    #Hitung LQ untuk setiap sektor dan tahun
    for tahun in range(2019, 2024):
        df[f'LQ_{tahun}'] = (df[f'Nilai_{tahun}_NIAS'] / total_nias[f'Nilai_{tahun}_NIAS']) / (df[f'Nilai_{tahun}_SUMUT'] / total_sumut[f'Nilai_{tahun}_SUMUT'])

    #Pilih kolom yang relevan untuk tabel LQ
    tabel_lq = df[['Sektor', 'LQ_2019', 'LQ_2020', 'LQ_2021', 'LQ_2022', 'LQ_2023']]

    # Save to Excel
    output_file_path = 'output.xlsx'
    with pd.ExcelWriter(output_file_path, engine='openpyxl') as writer:
        tabel_lq.to_excel(writer, sheet_name='Tabel_LQ', index=False)

    # Convert DataFrame to JSON
    lq_json = tabel_lq.to_json(orient='records')

    # Print JSON to stdout so Laravel can capture it
    print(lq_json)

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python process_data.py <path_to_excel_file>")
        sys.exit(1)

    excel_file_path = sys.argv[1]
    process_data(excel_file_path)
