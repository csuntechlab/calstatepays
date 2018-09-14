import pandas as pd

import numpy as np
import simplejson

class Data_Frame_Sanitizer:
    def __init__(self,file):
        '''
        This is a dataframes parent class,
        Majors and Industry dataframes are parsed in a similar manner.
        So we will parse the first couple of columns here. 
        Shared parsing functions will reside in the parent class
            dataFrame object init
                file, 
                csv general data frame
        '''
        self.file = file
        localFilePath = './csv/' + self.file+'.csv'
        self.df = pd.read_csv( localFilePath)
        # self.df.info()
        # print(self.df)
        self.sanitize_null_values()
        # self.print_column_headers()
        self.header_sanitizer()
        # self.print_column_headers()
        self.df = self.df.loc[self.df['student_path'].isin([1,2,4])]
        # print(self.df.keys())
        # print(self.df)


        # here we create the updated csv with the correct sanitizations
        # this data goes to sanitized_industries folder
        # we should probabily read these files which i swapped into csv directory
        # the caution is we'll be sanitizing it again, so maybe we can talk about this 
        # friday?
        # if "major" not in self.file: 
        #     name = self.file.replace("_updated_industry","")
        #     name = self.file.replace("_industry","")
        #     self.df.to_csv('sanitized_industries/'+name+'_industry.csv',index=False)
        pass
    
    def sanitize_null_values(self):
        '''
        Sanitizes null values
        '''
        self.df = self.df.rename(columns=lambda x: x.replace('#', 'number'))
        self.df = self.df.replace(['*****', np.NaN], np.NaN)

    def header_sanitizer(self):
        '''
        Sanitizes the header for each csv
        '''
        self.df.columns = self.df.columns.str.replace(' ','_')
        self.df.columns = self.df.columns.str.replace('#','number')
        # self.df.columns = self.df.columns.str.replace('.1','')                                                      
        self.df.columns = self.df.columns.str.lower()
        for i,col in enumerate(self.df.columns):
            if(col[0] in '123456789'):
                self.df = self.df.rename(index=str, columns={str(col): "_"+str(col)})
            elif(col == 'entry_stat'):
                self.df = self.df.rename(index=str, columns={str(col): 'entry_status'})
    
    def print_data_frame_headers(self):
        '''
        prints the header
        '''
        print (self.df.head())

    def print_column_headers(self):
        '''
        prints col headers
        '''
        for column in self.df:
            print(column)
    
    def __str__(self):
        '''
        prints dataframe
        '''
        print(self.df)
    
     # sanitize column
    def column_sanitize_plus(self,columnName):
        '''
        sanitize for col that has a plus
        '''
        self.df[columnName] = self.df[columnName].str.replace('+','')
        self.df[columnName] = self.df[columnName].str.replace(' ','')

    def column_sanitize_get_first_5(self,columnName):
        self.df[columnName] = self.df[columnName].str.slice(start=0, stop=5)
    
    # converts to floats...
    def string_number_to_real_number(self,columnName):
        self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

    def remove_dollar(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('$', '')

    def remove_hyphen(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('-','')

    def remove_comma(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace(',','')

    ### These are the common sanitizations that both jsons require
    def sanitizeCommon(self):
        self.column_sanitize_plus('hegis_at_exit')
        self.column_sanitize_get_first_5('hegis_at_exit')
        self.string_number_to_real_number('hegis_at_exit')

    ### Both jsons will need this method
    def dollar_column(self,columnName):
        self.remove_dollar(columnName)
        self.remove_comma(columnName)
        self.string_number_to_real_number(columnName)

