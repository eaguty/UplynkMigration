import urllib, zlib, hmac, hashlib, time, json
 
ROOT_URL = 'https://services.uplynk.com'
OWNER = '9046134590574d34a859a4b9b1ccadff' # CHANGE THIS TO YOUR USER ID
SECRET = 'dLHMS9dPGlERJdfUKYYAxO/q/mIOvBFG6IXNGXfB' # CHANGE THIS TO YOUR SECRET API KEY
 
def Call(uri, **msg):
    msg['_owner'] = OWNER
    msg['_timestamp'] = int(time.time())
    msg = json.dumps(msg)
    msg = zlib.compress(msg, 9).encode('base64').strip()
    sig = hmac.new(SECRET, msg, hashlib.sha256).hexdigest()
    body = urllib.urlencode(dict(msg=msg, sig=sig))
    return json.loads(urllib2.urlopen(ROOT_URL + uri, body).read())
 
asset = Call('/api2/asset/get', external_id='0_xa1yhm0n')



