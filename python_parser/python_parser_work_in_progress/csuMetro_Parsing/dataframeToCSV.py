class DfToCSV:
  def __init__(self,MajorsPathWageDataFrame,attachName):
    print('here')
    self.df = MajorsPathWageDataFrame
    self.name = attachName
    self.printCSV()
  
  def printCSV(self):
    aggregate = self.df.loc[self.df['campus'].isin([0])]
    aggregate.to_csv('./newCSV/aggregate'+self.name+'.csv', sep='\t', encoding='utf-8')

    northridge = self.df.loc[self.df['campus'].isin([70])]
    northridge.to_csv('./newCSV/northridge'+self.name+'.csv', sep='\t', encoding='utf-8')
