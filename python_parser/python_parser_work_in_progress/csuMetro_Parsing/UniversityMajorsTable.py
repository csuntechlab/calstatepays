import pandas as pd
import numpy as np
import json
import simplejson

class UniversitiesDataFrameErrorChecker():
  def __init__(self,csvfiles):
    self.csvFiles = csvfiles
    self.masterDF = pd.DataFrame()
    self.globalIndx = 1
    # to append masterDf = masterDf.append( newDf , ignore_index=True)
    pass

  def concat_all_csv_to_master_df(self):
    for csv in self.csvFiles:
      # fileName = csv.replace("_majors","")
      localFilePath = './csv/' + csv +'.csv'
      df = pd.read_csv( localFilePath )
      df = self.sanitize_df(df)
      df = self.create_base_university_majors_table(df)
      differentHegisSameMajor = self.find_duplicates(df)
      df = self.update_university_majors_table_with_duplicates(differentHegisSameMajor,df)
      self.create_dictionary_based_on_university_majors_table_with_duplicates(df,csv)
    
  def sanitize_df(self,df):
    df.columns = df.columns.str.lower()
    print(df.head())
    # TODO: fix this sometime 
    #df = df.rename(index=str, columns={'entry_stat': 'entry_status'})
    df.columns = df.columns.str.replace(' ','_')
    return df

  def create_base_university_majors_table(self,df):
    # TODO: also fix this entry stat
    df = df.loc[:,['campus','hegis_at_exit','major','student_path','entry_stat'] ]
    print(df)
    df['hegis_at_exit'] = df['hegis_at_exit'].astype(str)
    # df['hegis_at_exit'] = pd.to_numeric(df['hegis_at_exit'], errors='coerce')
    df = df.drop_duplicates(subset=['campus', 'hegis_at_exit','major'], keep='first')
    df.loc[:,'id'] = range(1, len(df) + 1) 
    # print(df)
    return df
  
  def find_duplicates(self,df):
    ids = df["id"]
    differentHegisSameMajorBoolean = df.duplicated(subset=['campus','major'], keep=False)
    differentHegisSameMajor = df[ids.isin( ids[ differentHegisSameMajorBoolean ] ) ]
    return differentHegisSameMajor
    pass
  
  def update_university_majors_table_with_duplicates(self,differentHegisSameMajor,df):
    for idx, row in differentHegisSameMajor.iterrows():
      duplicatedMajor = differentHegisSameMajor.at[idx,'major']
      hegis = differentHegisSameMajor.at[idx,'hegis_at_exit']
      df.at[idx,'major'] = duplicatedMajor + "-" + hegis
      

    return df
        
  
  def create_dictionary_based_on_university_majors_table_with_duplicates(self,df,csv):
    output = df.to_dict(orient='record')
    
    campusId =  int(output[0]['campus'])
    
    hegisDictionary = {}

    universityMajorsId = []

    for row in output:
      hegis =  (row['hegis_at_exit'])
      hegisDictionary[hegis] = self.globalIndx

      campus =  int(row['campus'])
      major =  (row['major'])
      dictRename = {'hegis_codes': hegis,'university_id':campus,'major':major,'id':self.globalIndx }
      universityMajorsId.append(dictRename)
      
      self.masterDF = df.append( dictRename , ignore_index=True)
      
      self.globalIndx +=1
    del output
    
    dictionary  = {campusId:hegisDictionary}

    # print(self.file)
    
    with open('./dictionaries/'+csv+'.json','w') as fp:
        fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()  
    
    df['hegis_at_exit'] = pd.to_numeric(df['hegis_at_exit'], errors='coerce')
    output = df.to_dict(orient='record')
    with open ('../../database/data/'+csv+'.json', 'w' ) as fp:
      fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()
    return dictionary
    pass
  
  def concat_dictionary_to_master_dictionary(self,df):

    return df
    pass


  