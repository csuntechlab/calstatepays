import pandas as pd

import numpy as np
import simplejson

# 
# may reuse getDictionary 
# jsonOutput
# getIndustryPathTypesDfTable
# sanitizeImage
class create_naics_dataFrame():
  def __init__(self,file):
    self.file = file
    localFilePath = './csv/' + self.file + '.csv'
    self.df = pd.read_csv( localFilePath )
    self.df = self.df.loc[:,['industry']]
    self.df = self.df.drop_duplicates(subset=['industry'], 
    keep='first')
  
  def getDataFrame(self):
    return self.df

  def getImages(self,masterNaicsDataFrame):
    masterNaicsDataFrame['images'] = -1

    for index,row in masterNaicsDataFrame.iterrows():
      print(row[0]) # industry name
      print(row[1]) # id 
      print(row[2]) # images 
      print("********")

      # campus = row[0]
      # age_range_str = row[2]
      # age_range_id = age_range[age_range_str]

      # annual_earnings_str = row[4]
      # annual_earnings_id = annual_earnings[annual_earnings_str]

      # annual_financial_aid_str = row[5]
      # annual_financial_aid_id = annual_financial_aid[annual_financial_aid_str]

      # masterNaicsDataFrame.ix[index,'age_range'] = age_range_id
      # masterNaicsDataFrame.ix[index,'annual_earnings_during_school'] = annual_earnings_id
      # masterNaicsDataFrame.ix[index,'annual_financial_aid'] = annual_financial_aid_id

      # # uni_majors_id = self.dictionary[campus][hegis] 
      # # masterNaicsDataFrame.ix[index,'university_majors_id'] = uni_majors_id
      # masterNaicsDataFrame.ix[index,'id'] = self.indexID
      # masterNaicsDataFrame.ix[index,'student_background_id'] = self.indexID
      # self.indexID += 1
    return masterNaicsDataFrame
    pass

  def sanitizeImage(self,image):
    if( ',' in image):
      image = image.replace(',', "")
    if('&' in image):
      image = image.replace('& ',"")
    if(' ' in image):
      image = image.replace(' ',"_")
    
    image = image.lower()
  
    return image+".png"