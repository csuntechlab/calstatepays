import pandas as pd
import numpy as np
import json
import simplejson
import os
from os import listdir
from os.path import isfile, join

class UniversitiesDataFrameErrorChecker():
  def __init__(self,csvfiles):
    self.csvFiles = csvfiles
    self.masterDF = pd.DataFrame()
    self.globalIndx = 1
    # to append masterDf = masterDf.append( newDf , ignore_index=True)
    pass

  def get_master_df(self):
      # print(self.masterDF)
      master = self.masterDF.to_dict(orient='record')
      fileName = './master_majors_university_table_new.json'
      with open (fileName, 'w' ) as fp:
        fp.write(simplejson.dumps(master, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
      fp.close()
      return self.masterDF


  def concat_all_csv_to_master_df(self):
    for csv in self.csvFiles:
      # fileName = csv.replace("_majors","")
      localFilePath = './csv/' + csv +'.csv'
      df = pd.read_csv( localFilePath )
      df = self.sanitize_df(df)
      df = self.create_base_university_majors_table(df)
      differentHegisSameMajor,sameHegisDifferentMajor = self.find_duplicates(df)
      df = self.update_university_majors_table_with_duplicates(differentHegisSameMajor,sameHegisDifferentMajor,df,csv)
      self.create_dictionary_based_on_university_majors_table_with_duplicates(df,csv)
    self.get_master_df()
    
  def sanitize_df(self,df):
    df.columns = df.columns.str.lower()
    df.columns = df.columns.str.replace(' ','_')
    df = df.loc[df['student_path'].isin([1,2,4])]
    df = df.loc[df['entry_stat'].isin(['FTF + FTT'])]
    return df

  def create_base_university_majors_table(self,df):
    # TODO: also fix this entry stat
    df = df.loc[:,['campus','hegis_at_exit','major','student_path','entry_stat'] ]
    df['hegis_at_exit'] = df['hegis_at_exit'].astype(str)
    df['hegis_at_exit'] = pd.to_numeric(df['hegis_at_exit'], errors='coerce')
    df = df.drop_duplicates(subset=['campus', 'hegis_at_exit','major'], keep='first')
    lenOfDf = len(df) + self.globalIndx
    df.loc[:,'id'] = range(self.globalIndx,lenOfDf) 
    self.globalIndx = lenOfDf
    return df
  
  def find_duplicates(self,df):
    ids = df["id"]
    differentHegisSameMajorBoolean = df.duplicated(subset=['campus','major'], keep=False)
    differentHegisSameMajor = df[ids.isin( ids[ differentHegisSameMajorBoolean ] ) ]

    ids = df["id"]
    sameHegisDifferentMajorBoolean = df.duplicated(subset=['campus','hegis_at_exit'], keep=False)
    sameHegisDifferentMajor = df[ids.isin( ids[ sameHegisDifferentMajorBoolean ] ) ]

    sameHegisDifferentMajor = sameHegisDifferentMajor.drop_duplicates(subset=['hegis_at_exit'], keep='first')

    return differentHegisSameMajor,sameHegisDifferentMajor
  
  def update_university_majors_table_with_duplicates(self,differentHegisSameMajor,sameHegisDifferentMajor,df,csv):
    
    hegisToMajorDictionary = {}
    
    for idx, row in differentHegisSameMajor.iterrows():
      duplicatedMajor = differentHegisSameMajor.at[idx,'major']
      hegis = differentHegisSameMajor.at[idx,'hegis_at_exit']
      strHegis = str(hegis).replace('.0',"")
      df.at[idx,'major'] = duplicatedMajor + "-" + strHegis
      major = df.at[idx,'major']
      hegisToMajorDictionary[int(hegis)] = major
    dictionary = hegisToMajorDictionary
    with open('./hegisToMajorDictionary/'+csv.replace("_majors","")+'.json','w') as fp:
        fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()  
    # for idx, row in sameHegisDifferentMajor.iterrows():
    #   duplicatedMajor = sameHegisDifferentMajor.at[idx,'major']
    #   hegis = sameHegisDifferentMajor.at[idx,'hegis_at_exit']
    #   strHegis = str(hegis).replace('.0',"")
    #   df.at[idx,'hegis_at_exit'] = strHegis + strHegis
    #   df.at[idx,'major'] = duplicatedMajor + "-" + strHegis+strHegis

    # print('smaeHEgisDifferentMajor')
    # print(sameHegisDifferentMajor)
    # print('differentHegisSameMajor')
    # print(differentHegisSameMajor)
    return df
        
  
  def create_dictionary_based_on_university_majors_table_with_duplicates(self,df,csv):
    output = df.to_dict(orient='record')
    
    campusId =  int(output[0]['campus'])
    
    hegisDictionary = {}
    universityMajorsId = []

    for row in output:
      hegis = int(row['hegis_at_exit'])
      index = row['id']
      hegisDictionary[hegis] = index
      campus =  int(row['campus'])
      major =  (row['major'])
      dictRename = {'hegis_codes': hegis,'university_id':campus,'major':major,'id':index }
      universityMajorsId.append(dictRename)
      self.masterDF = self.masterDF.append( dictRename , ignore_index=True)  
    dictionary  = {campusId:hegisDictionary}
    
    with open('./dictionaries/'+csv.replace("_majors","")+'.json','w') as fp:
        fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()  
   
    # with open ('../../database/data/'+csv.replace("_majors","")+'.json', 'w' ) as fp:
    #   fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    # fp.close()
    self.concat_dictionary_to_master_dictionary()
    return dictionary

  def get_dict(self):
        path = os.getcwd() + '/dictionaries'
        dictFiles = [csvFile for csvFile in listdir(path) 
        if isfile(join(path, csvFile)) ]

        return dictFiles
 
  
  def concat_dictionary_to_master_dictionary(self):
    dictFiles = self.get_dict()
    masterDict = {}
    for dictFile in dictFiles:
        with open(os.getcwd() + '/dictionaries/'+dictFile) as f:
            data = json.load(f)
            masterDict = {**masterDict, **data}
    
    fileName = './master_major_dictionary.json'
    with open (fileName, 'w' ) as fp:
        fp.write(simplejson.dumps(masterDict, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()

    return masterDict

  