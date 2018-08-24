import pandas as pd
import numpy as np
import json
import simplejson

class hegisID:
    def __init__(self,df):
        self.df = df

    def head(self):
        print(self.df.head())

    def convert_To_Json(self):
        self.df['hegis_codes'] = (self.df['hegis_codes']).astype(int)
        self.df['id'] = (self.df['hegis_codes']).astype(int)
        self.df['university_id'] = (self.df['hegis_codes']).astype(int)
        output = self.df.to_dict(orient='record')

        with open ('../../database/data/MasterUniversityTable.json', 'w' ) as fp:
            fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
        fp.close()

        # json_data = json.load(open('../../database/data/MasterUniversityTable.json'))

        
        # with open('../../database/data/MasterUniversityTable.json', 'w') as outfile:
        #     json.dump(json_data, outfile, indent=4)

        print(self.df.head())


        




    
    
