import pandas as pd
import numpy as np
import json
import simplejson


import simplejson
import json

class UniversitiesDataFrameErrorChecker(Data_Frame_Sanitizer):
  def __init__(self,csvfiles):
    self.csvFiles = csvfiles
    pass

  def concat_all_csv_to_master_df(self):
    for csv in self.csvFiles:
      localFilePath = './csv/' + self.file+'.csv'
      df = pd.read_csv( localFilePath )
      df = self.sanitize_df(df)
      df = self.create_base_university_majors_table(df)

      

    pass

  def sanitize_df(self,df):
    df.columns = df.columns.str.lower()
    for i,col in enumerate(df.columns):
        if(col == 'entry_stat'):
            df = df.rename(index=str, columns={str(col): 'entry_status'})
    return df

  def create_base_university_majors_table(self,df):
    df = df.loc[:,['campus','hegis_at_exit','major','student_path','entry_status'] ]
    df = df.drop_duplicates(subset=['university_id', 'hegis_codes'], keep='first')
    return df
  
  def find_duplicates(self):
    pass
  
  def update_university_majors_table_with_duplicates(self):
    pass
  
  def create_dictionary_based_on_university_majors_table_with_duplicates(self):
    pass
  
  def concat_dictionary_to_master_dictionary(self):
    pass


  