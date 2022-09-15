import zlib

print ("hello xorld")

data = 'eJxzrHItCqn0zC8AABBiA2g'

data = data if isinstance(data, bytes) else data.encode('utf-8')
ah = zlib.decompress(data)

print (ah)