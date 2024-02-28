import numpy

myList = [2,3,1,3,2,2,1,1,3]

myList[1],myList[0] = myList[0],myList[1]
myList[4],myList[3] = myList[3],myList[4]
myList[4],myList[6] = myList[6],myList[4]
myList[5],myList[8] = myList[8],myList[5]
myList[6],myList[7] = myList[7],myList[6]
myList = numpy.array(myList).reshape(3, 3).tolist()

print(myList)
