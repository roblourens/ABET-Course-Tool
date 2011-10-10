import sys, json

def typeStr(s):
    return str(type(s))[7:][:-2]

def generateSchema(obj, options):
    schemaObj = {}
    objType = {
                'dict': 'object',
                'list': 'array',
                'int':  'number',
                'float':'number',
                'str':  'string',
                'unicode': 'string'
    }[typeStr(obj)]

    schemaObj['type'] = objType

    if objType=='object':
        schemaObj['properties'] = {}
        for prop in obj:
            schemaObj['properties'][prop] = generateSchema(obj[prop], options)
            for k in options:
                schemaObj['properties'][prop][k] = (options[k].lower() == 'true')

    elif objType=='array':
        schemaObj['items'] = generateSchema(obj[0], options)

    return schemaObj

if len(sys.argv) < 3:
    print("Usage: python generateSchema.py <in_path> <out_path> optional: object_property_name:<true, false>")
else:
    f = open(sys.argv[1], 'r')
    j = json.loads(f.read())
    schemaObj = generateSchema(j, {k:v for (k,v) in [s.split(':') for s in sys.argv[3:]]})
    outFile = open(sys.argv[2], 'w')
    outFile.write(json.dumps(schemaObj, indent=4))

    f.close()
    outFile.close()
