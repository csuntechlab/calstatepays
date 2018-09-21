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
    masterNaicsDataFrame['image'] = -1

    naicsDictionary = {}
    for index,row in masterNaicsDataFrame.iterrows():
      # print(row[0]) # industry name
      # print(row[1]) # id 
      # print(row[2]) # images 
      # print("********")
      naicsDictionary[row[0]] = row[1]
      image = "/images/industry/" + self.sanitizeImage(row[0])
      masterNaicsDataFrame.ix[index,'image'] = image

    return masterNaicsDataFrame,naicsDictionary

  def sanitizeImage(self,image):

    if( ',' in image):
      image = image.replace(',', "")
    if('&' in image):
      image = image.replace('& ',"")
    if(' ' in image):
      image = image.replace(' ',"_")
    
    image = image.lower()
  
    return image+".png"