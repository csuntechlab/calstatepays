
# coding: utf-8

# In[11]:


import pandas as pd
import numpy as np
df = pd.read_csv('main-industry-sheet.csv')


# In[2]:


# df.columns = df.columns.str.strip()
df.columns = df.columns.str.replace(' ','_')


# In[4]:


df = df.rename(columns=lambda x: x.replace('#', 'number'))


# In[5]:


df


# In[13]:


df = df.replace(['*****', np.NaN], 'null')


# In[14]:


df


# In[21]:


output = df.to_json(path_or_buf='master_industry_page_data.json', orient='records' , lines=True)

