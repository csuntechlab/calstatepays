
# coding: utf-8

# In[11]:


import pandas as pd
import numpy as np
import json


df = pd.read_csv('master_major.csv')

df.columns = df.columns.str.replace(' ','_')
df.columns = df.columns.str.lower()


for i,col in enumerate(df.columns):
  if(col[0] in '123456789'):
    df = df.rename(index=str, columns={str(col): "_"+str(col)})



df = df.replace(['*****', np.NaN], 'null')
df = df.rename(columns=lambda x: x.replace('#', 'number'))



output = df.to_dict(orient='record')



with open ('master_major_page_data.json', 'w' ) as fp:
  fp.write(json.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False))