# import pandas as pd

# import numpy as np
# import simplejson

# # from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer
# from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer.py


# class Sanitize_Major(Data_Frame_Sanitizer):
#     def __init__(self,file):
#         super().__init__(file)
#         self.sanitizeCommon()
#         self.df = self.df.loc[self.df['year'].isin([2,5,10,15])]
#         # print(self.df)
#         pass

#     def sanitize_Major(self):
#         '''
#         Sanitizes these Majors CSV Specific Columns
#         '''
#         mapper = {
#             'potential_number_of_students':self.string_number_to_real_number('potential_number_of_students') ,
#             'potential_number_of_students_for_each_year_out_of_school':self.string_number_to_real_number('potential_number_of_students_for_each_year_out_of_school'),
#             '_25th_percentile_earnings':self.dollar_column('_25th_percentile_earnings'),
#             '_50th_percentile_earnings':self.dollar_column('_50th_percentile_earnings'),
#             '_75th_percentile_earnings':self.dollar_column('_75th_percentile_earnings'),
#             'average_earnings':self.dollar_column('average_earnings'),
#             'number_of_students_found':self.string_number_to_real_number('number_of_students_found')
#         }
#         for column in self.df:
#             pd.Series(column).map(mapper)
#         return self.df
    
#     def get_University_Majors_Dictionary_Data_Frame(self):
#         UnivMajorDictionaryDf = self.df.loc[:,['campus','hegis_at_exit','major'] ]
#         UnivMajorDictionaryDf = UnivMajorDictionaryDf.drop_duplicates(subset=['campus', 'hegis_at_exit','major'], keep='first')
#         UnivMajorDictionaryDf['campus'] = UnivMajorDictionaryDf['campus'].astype('float')
#         UnivMajorDictionaryDf['hegis_at_exit'] = UnivMajorDictionaryDf['hegis_at_exit'].astype('float')
        
#         return UnivMajorDictionaryDf
        

#     def get_Majors_Paths_Data_Frame(self):
#         MajorPathDf = self.df.loc[:,['student_path','entry_status','year','hegis_at_exit','campus']]
#         MajorPathDf.loc[:,'id'] = range(1, len(MajorPathDf) + 1) # TODO: May have messed up here
#         MajorPathWageDf = self.df.loc[:,['_25th_percentile_earnings','_50th_percentile_earnings','_75th_percentile_earnings']]
#         # MajorPathWageDf.loc[:,'major_path_id'] = MajorPathDf.loc[:,['id']] # TODO: May Have messed up here
#         MajorPathWageDf.loc[:,'major_path_id'] = range(1, len(MajorPathDf) + 1) # TODO: May Have messed up here
#         # print(MajorPathDf)
#         # print(MajorPathWageDf)
#         return MajorPathDf,MajorPathWageDf