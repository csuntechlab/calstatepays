import numpy as np
import pandas as pd
import simplejson
import json

# do we need a child - parent ?
# made this file because the initial sanitization does not add up with csv helper.py

class Sanitize_Pfre():

    def __init__(self,file, globalIndex ):
        self.file = file
        self.globalIndex = globalIndex
        localFilePath = './csv/' + self.file+'.csv'
        self.df = pd.read_csv(localFilePath)
        self.sanitizeHeaders()
        # print(list(self.df))
        self.set_index()
        self.dictionary = self.get_Dictionary()
        self.set_values_for_data_frame()
        self.sanitize_data_frame()

    def set_index(self):
        lenOfDf = len(self.df) + self.globalIndex
        self.df.loc[:,'id'] = range(self.globalIndex,lenOfDf) 
        self.df.loc[:,'student_background_id'] = range(self.globalIndex,lenOfDf) 
        self.globalIndex = lenOfDf
    
    def get_global_index(self):
        return self.globalIndex
    
    def sanitizeHeaders(self):
        self.df.columns = self.df.columns.str.replace('- ','')
        self.df.columns = self.df.columns.str.replace(' ','_')
        self.df.columns = self.df.columns.str.replace('(','')
        self.df.columns = self.df.columns.str.replace(')','')
        self.df.columns = self.df.columns.str.lower()
        # print(self.df.columns)
    
    def get_Dictionary(self):
        fileName = self.file.replace("_pfre","")
        jsonFile = open('./majorToId/'+fileName+'.json')
        dictionary = jsonFile.read()
        dictionary = json.loads(dictionary)
        return dictionary

    def set_values_for_data_frame(self):
        self.df['university_majors_id'] = -1
        
        age_range = {'19 years or less':1,'20-23 years':2,'24-30 years':3,'More than 30 years':4}
        annual_earnings = {'$0 ':1,'$1 - $4,500':2,'$4,501 - $10,500':3,'$10,501 - $18,000':4,'> $18,000':5}
        annual_financial_aid = {'$0 ':1,'FA Range 1':2,'FA Range 2':3,'FA Range 3':4,'FA Range 4':5}

        for index,row in self.df.iterrows():
            # print(row[0]) # campus : campus-id
            # print(row[1]) # location : campus-name
            # print(row[2]) # age_range : age_range_str
            # print(row[3]) # entry_stat : Entry-status
            # print(row[4]) # annual_earnings_during_school
            # print(row[5]) # annual_financial_aid
            # print(row[6]) # major
            # print(row[7]) # estimated_time_to_degree_(years)
            # print(row[8]) # estimated_earnings_5_years_after_exit
            # print(row[9]) # fre_financial_return_on_education
            # print(row[10]) # university_majors_id
            # print(row[11]) # id
            # print(row[12]) # student_background_id
            # print("**********")

            major = row['major']

            age_range_str = row['age_range']
            age_range_id = age_range[age_range_str]

            annual_earnings_str = row['annual_earnings_during_school']
            annual_earnings_id = annual_earnings[annual_earnings_str]

            annual_financial_aid_str = row['annual_financial_aid']
            annual_financial_aid_id = annual_financial_aid[annual_financial_aid_str]

            uni_majors_id = self.dictionary[major]
            

            self.df.ix[index,'age_range'] = age_range_id
            self.df.ix[index,'annual_earnings_during_school'] = annual_earnings_id
            self.df.ix[index,'annual_financial_aid'] = annual_financial_aid_id
            self.df.ix[index,'annual_financial_aid'] = annual_financial_aid_id
            self.df.ix[index,'university_majors_id'] = annual_financial_aid_id
            
            # self.df.ix[index,'university_majors_id'] = uni_majors_id
            # self.df.ix[index,'student_background_id'] = self.indexID
    
    def sanitize_data_frame(self):
        '''
        Sanitizes these Majors CSV Specific Columns
        '''
        mapper = {
            'estimated_earnings_5_years_after_exit':self.remove_dollar('estimated_earnings_5_years_after_exit') ,
            'fre_financial_return_on_education':self.remove_percent('fre_financial_return_on_education'),
            'annual_earnings_during_school':self.string_number_to_real_number('annual_earnings_during_school'),
            'annual_financial_aid':self.string_number_to_real_number('annual_financial_aid'),
        }
        for column in self.df:
            pd.Series(column).map(mapper)

    def get_student_path_and_investments_data_frame(self):
        studentPathDataFrame = self.df.loc[:,['campus','age_range','entry_stat','university_majors_id','id']] # TODO: add hegis later
        
        investmentsDataFrame = self.df.loc[:,['student_background_id','annual_earnings_during_school','annual_financial_aid','estimated_time_to_degree_years','estimated_earnings_5_years_after_exit','fre_financial_return_on_education','id']] 

        return studentPathDataFrame,investmentsDataFrame

    def string_number_to_real_number(self,columnName):
        self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

    def remove_dollar(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('$', '')
        self.df[columnName] = self.df[columnName].str.replace(',', '')
        self.string_number_to_real_number(columnName)
    
    def remove_percent(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('%', '')
        self.string_number_to_real_number(columnName)