
# coding: utf-8

# In[11]:


import pandas as pd
import numpy as np
import json

df = pd.read_csv('main-industry-sheet.csv')

df.columns = df.columns.str.replace(' ','_')
df.columns = df.columns.str.lower()

df = df.rename(columns=lambda x: x.replace('#', 'number'))

df = df.replace(['*****', np.NaN], 'null')

output = df.to_dict(orient='record')

with open ('master_industry_page_data.json', 'w' ) as fp:
  fp.write(json.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False))