from datetime import datetime, timedelta, date
import numpy as np
import pandas as pd
import os
import sqlalchemy as db
import pymysql
from sqlalchemy.sql import select

def selectmodem(devtype,devint):
    engine = db.create_engine('mysql+pymysql://user:pass@hostname:3306/db')
    result = engine.execute("SELECT interfaceid FROM mapping WHERE device =%s AND interface =%s", devtype, devint)
    return result

def SQLlist():
    engine = db.create_engine('mysql+pymysql://user:pass@hostname:3306/db')
    result = engine.execute("SELECT * FROM pdhnec")
    return result

def SQLlist10(i):
    engine = db.create_engine('mysql+pymysql://user:pass@hostname:3306/db')
    upper = i * 10
    lower = upper - 9
    result = engine.execute("SELECT * FROM pdhnec WHERE id BETWEEN %s AND %s",lower,upper)
    return result

def maxusage():
    #establishing dates
    today = date.today()
    d1 = today.strftime("%Y%m%d")
    yesterday = date.today() - timedelta(days=1)
    d2 = yesterday.strftime("%Y%m%d")
    d2edit = yesterday.strftime("%Y-%m-%d")
    d2sql = '%'+d2edit+'%'
    engine = db.create_engine('mysql+pymysql://user:pass@hostname:3306/db')
    pdhtable = SQLlist()
    for row in pdhtable:
        trafficport = selectmodem(row[8],row[5])
        for list in trafficport:
                queries = engine.execute("SELECT MAX(GREATEST(tx,rx)) AS maxocc FROM rmon WHERE stamp LIKE %s AND neip =%s AND neint =%s", d2sql, row[4], list[0])
                for query in queries:
                        print query[0]
                        if query[0] is not None:
                                engine.execute("UPDATE pdhnec SET maxusage = ROUND(%s,2) WHERE linkid=%s AND neint=%s AND neip=%s",query[0],row[1],row[5],row[4])

def maxocc():
    #establishing dates 
    engine = db.create_engine('mysql+pymysql://user:pass@hostname:3306/db')
    queries = engine.execute("UPDATE pdhnec SET maxocc = ROUND(maxusage/bw*100,2)")

def device(neid):
    engine = db.create_engine('mysql+pymysql://user:pass@hostname:3306/db')
    result = engine.execute("""SELECT * FROM pdhnec 
                            WHERE neid=%s""",neid)
    for row in result :
        print row[0]
