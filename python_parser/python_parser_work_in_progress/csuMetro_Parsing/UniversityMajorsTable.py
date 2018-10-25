import pandas as pd
import numpy as np
import json
import simplejson
import os
from os import listdir
from os.path import isfile, join

from csuMetro_Parsing.jsonOutput import JsonOutPut

class UniversitiesDataFrameErrorChecker():
  def __init__(self,csvfiles,typeOfCsv):
    self.typeOfCsv = typeOfCsv
    self.csvFiles = csvfiles
    self.masterDF = pd.DataFrame()
    self.globalIndx = 1
    self.jsonOutputter = JsonOutPut()
    # to append masterDf = masterDf.append( newDf , ignore_index=True)
    pass

  def get_master_df(self):
    print('self.masterDF')
    self.string_number_to_real_number('id')
    self.string_number_to_real_number('hegis_codes')
    self.string_number_to_real_number('campus')

    master = self.masterDF.to_dict(orient='record')
    filePath = './master_majors_university_table_new.json'
    self.jsonOutputter.json_output_with_simple_json(filePath, master)
  
  def string_number_to_real_number(self,columnName):
    self.masterDF[columnName] = pd.to_numeric(self.masterDF[columnName], errors='coerce', downcast='integer')


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
    
    #TODO: ERROR CHECKING COMMENT THIS OUT 
    df = df.loc[df['student_path'].isin([1,2,4])]
    df = df.loc[df['entry_stat'].isin(['FTF + FTT'])]
    df = df.loc[df['year'].isin([2,5,10,15])]
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

    # sameHegisDifferentMajor = sameHegisDifferentMajor.drop_duplicates(subset=['hegis_at_exit'], keep='first')

    print(self.typeOfCsv)
    filePath = '../../database/data/errors/'+self.typeOfCsv
    
    self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePath + "_different_hegis_same_major.json",differentHegisSameMajor)
    self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePath + "_same_hegis_different_major.json",sameHegisDifferentMajor)

    return differentHegisSameMajor,sameHegisDifferentMajor
  
  def update_university_majors_table_with_duplicates(self,differentHegisSameMajor,sameHegisDifferentMajor,df,csv):
    
    hegisToMajorDictionary = {}
    
    for idx, row in differentHegisSameMajor.iterrows():
      duplicatedMajor = differentHegisSameMajor.at[idx,'major']
      hegis = differentHegisSameMajor.at[idx,'hegis_at_exit']
      strHegis = str(hegis).replace('.0',"")
      newMajorName = str(duplicatedMajor) + "-" + strHegis
      df.at[idx,'major'] = newMajorName
      major = df.at[idx,'major']
      hegisToMajorDictionary[int(hegis)] = major

    filePath = './hegisToMajorDictionary/'+csv.replace("_majors","")+'.json'
    
    self.jsonOutputter.json_output_with_simple_json(filePath,hegisToMajorDictionary)
    # for idx, row in sameHegisDifferentMajor.iterrows():
    #   duplicatedMajor = sameHegisDifferentMajor.at[idx,'major']
    #   hegis = sameHegisDifferentMajor.at[idx,'hegis_at_exit']
    #   strHegis = str(hegis).replace('.0',"")
    #   df.at[idx,'hegis_at_exit'] = strHegis + strHegis
    #   df.at[idx,'major'] = duplicatedMajor + "-" + strHegis+strHegis
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
      dictRename = {'hegis_codes': hegis,'campus':campus,'major':major,'id':index }
      universityMajorsId.append(dictRename)
      self.masterDF = self.masterDF.append( dictRename , ignore_index=True)  
    dictionary  = {campusId:hegisDictionary}
    
    filePath = './dictionaries/'+csv.replace("_majors","")+'.json' 
    
    self.jsonOutputter.json_output_with_simple_json(filePath,dictionary)

    self.concat_dictionary_to_master_dictionary()

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
    
    filePath = './dictionaries/master_major_dictionary.json'
    self.jsonOutputter.json_output_with_simple_json(filePath,masterDict)

  