import pandas as pd
import numpy as np
import simplejson

class AggregateCsvFiles():
  
    def __init__(self):
        pass
    
    def aggregate_majors_csv_to_json(self,aggregateCsvFiles):
      indexUniversityMajorsId = 1  
      indexMajorPathId = 1  
      
      universityMajorsDataFrame = pd.DataFrame()
      MajorsPathsDataFrame = pd.DataFrame()
      MajorsPathWageDataFrame = pd.DataFrame()

      for csv in aggregateCsvFiles:
        file = csv
        localFilePath = './csv/' + file+'.csv'
        self.df = pd.read_csv( localFilePath )
        self.sanitize_null_values()
        self.header_sanitizer()
        self.sanitizeCommon()
        print(self.df.head())
        dfHegisCodes  = self.df.loc[:,['campus','hegis_at_exit','majors',] ]
        print(dfHegisCodes.head())

        errorDataFrame = self.df.loc[:,['campus','hegis_at_exit','majors','student_path','entry_status'] ]
        errorDataFrame = errorDataFrame.drop_duplicates(subset=['campus', 'hegis_at_exit','majors'], keep='first')
        errorDataFrame.loc[:,'id'] = range(1, len(errorDataFrame) + 1) 
        duplicateHegisCodeDifferentMajor = errorDataFrame

        print(errorDataFrame.head())

        ids = errorDataFrame["id"]
        errorBoolean = errorDataFrame.duplicated(subset=['campus','majors'], keep=False)
        errorDataFrame = errorDataFrame[ids.isin( ids[ errorBoolean ] ) ]
        # self.json_output('master_errors_table',errorDataFrame)
        
        ids = duplicateHegisCodeDifferentMajor["id"]       
        errorBoolean = duplicateHegisCodeDifferentMajor.duplicated(subset=['campus','hegis_at_exit'], keep=False)
        duplicateHegisCodeDifferentMajor = duplicateHegisCodeDifferentMajor[ids.isin( ids[ errorBoolean ] ) ]

        self.json_output("aggregate_different_hegis_same_major",errorDataFrame)
        self.json_output("aggregate_same_hegis_different_major",duplicateHegisCodeDifferentMajor)

        # return errorDataFrame,duplicateHegisCodeDifferentMajor
     
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
        self.remove_comma(columnName) 
        self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

    def remove_dollar(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('$', '')

    def remove_hyphen(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('-','')

    def remove_comma(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace(',','')

    ### These are the common sanitizations that both jsons require
    def sanitizeCommon(self):
        self.df['hegis_at_exit'] = self.df['hegis_at_exit'].astype(str)
        self.column_sanitize_plus('hegis_at_exit')
        self.column_sanitize_get_first_5('hegis_at_exit')
        self.string_number_to_real_number('hegis_at_exit')

    ### Both jsons will need this method
    def dollar_column(self,columnName):
        self.remove_dollar(columnName)
        self.remove_comma(columnName)
        self.string_number_to_real_number(columnName)
    
    def json_output(self,fileName, df):
      output = df.to_dict(orient='record')

      with open ('../../database/data/'+fileName+'.json', 'w' ) as fp:
        fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
      fp.close()




