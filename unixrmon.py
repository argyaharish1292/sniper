from datetime import datetime, timedelta, date
from ftplib import FTP
import ftplib
import numpy as np
import pandas as pd
from pandas.io import sql
import matplotlib.pyplot as plt
from zipfile import ZipFile
import os
import sqlalchemy as db
import pymysql
from actsql import selectmodem, SQLlist,SQLlist10

def GetRMON(devip,devint):
    #establishing dates
    yesterday = date.today() - timedelta(days=1)
    d2 = yesterday.strftime("%Y%m%d")
    #connect to ftp
    try:
        ftp = FTP(devip)
        ftp.login(user='Admin', passwd='12345678')
        #change to rmon /export/rmon/ directory in the ftp server
        ftp.cwd('/export/rmon/')
        #establishing file naming variable
        filename = '15min-ETH-'+devint+'-'+d2+'.zip'
        filermon = '15min-ETH-'+devint+'-'+d2+'.rmon'
        #create new folder specific to device ip if never been created before
        dir = os.path.join('/home','rto_sbs','sniff',devip)
        if not os.path.exists(dir):
            os.makedirs(dir,0777)
            os.umask(000)
        #establishing file naming variable  
        loc_zip = os.path.join(dir,filename)
        loc_unzip = os.path.join(dir,filermon)
        #copying files from ftp to local
        my_file = open(loc_zip, 'wb')
        ftp.retrbinary('RETR ' + filename,my_file.write)
        my_file.close()
        #unzipping files
        os.chdir(dir)
        if os.path.exists(loc_zip):
            with ZipFile(loc_zip, 'r') as zipObj:
                zipObj.extractall()
        else :
            print ('Folder does not exist')
    except ftplib.all_errors:
        pass

def plot(devip,devint):
    #establishing dates
    yesterday = date.today() - timedelta(days=1)
    d2 = yesterday.strftime("%Y%m%d")
    #importing to panda dataframe
    filermon = filermon = '15min-ETH-'+devint+'-'+d2+'.rmon'
    loc_unzip = os.path.join('/home','rto_sbs','sniff',devip,filermon)
    df = pd.read_csv(loc_unzip, skiprows=1)
    df.index =df['Time Stamp']
    #converting to Mbps
    Txmbps = df['HCTxetherStatsOctets'] * 8 / 900 / 1000000
    Rxmbps = df['HCRxetherStatsOctets'] * 8 / 900 / 1000000
    #plotting
    fig, ax = plt.subplots()
    ax.plot(df.index, Txmbps)
    ax.plot(df.index, Rxmbps)
    plt.xticks(rotation=90)
    for label in ax.get_xaxis().get_ticklabels()[::2]:
        label.set_visible(False)
    plt.xlabel('Time')
    plt.ylabel('RMON Usage (Mbps)')
    plt.legend(('TX Mbps','RX Mbps'))
    plt.show()

def toSQL(devip,devint):
    #establishing dates
    today = date.today()
    d1 = today.strftime("%Y%m%d")
    yesterday = date.today() - timedelta(days=1)
    d2 = yesterday.strftime("%Y%m%d")
    d2edit = yesterday.strftime("%Y-%m-%d")
    #importing to panda dataframe
    filermon = filermon = '15min-ETH-'+devint+'-'+d2+'.rmon'
    loc_unzip = os.path.join('/home','rto_sbs','sniff',devip,filermon)
    try:
        df = pd.read_csv(loc_unzip, skiprows=1)
        #creating custom dataframe to export to sql
        datetime = d2edit+' '+df['Time Stamp']
        Txmbps = df['HCTxetherStatsOctets'] * 8 / 900 / 1000000
        Rxmbps = df['HCRxetherStatsOctets'] * 8 / 900 / 1000000
        rxdrops = df['RxetherStatsDropEvents']
        crc = df['RxetherStatsCRCAlignErrors']
        unknownvid = df['HCRxUnknownVID']
        qdrops = df['HCTxQueue0Discard']
        df.insert(1,'stamp',datetime)
        df.insert(2,'neip',devip)
        df.insert(3,'neint',devint)
        df.insert(4,'tx',Txmbps)
        df.insert(5,'rx',Rxmbps)
        df.insert(6,'rxdrops',rxdrops)
        df.insert(7,'crc',crc)
        df.insert(8,'unknownvid',unknownvid)
        df.insert(9,'qdrops',qdrops)
        #the custom/temporary dataframe
        df2 = df[["stamp","neip","neint","tx","rx","rxdrops","crc","unknownvid","qdrops"]]
        #connecting to MySQL database
        engine = db.create_engine('mysql+pymysql://admin:admin2019@10.35.105.55:3306/sniff')
        #exporting dataframe to sql
        df2.to_sql(name='rmon', con=engine, if_exists='append', index=False)
    except IOError:
        pass

#Bug in function do not use
def GetAll():
    pdhtable = SQLlist()
    for row in pdhtable:
        trafficport = selectmodem(row[8],row[5])
        for list in trafficport:
            try:
                GetRMON(row[4],list[0])
                toSQL(row[4],list[0])
            except:
                pass

def GetRMONAll():
    pdhtable = SQLlist()
    for row in pdhtable:
        trafficport = selectmodem(row[8],row[5])
        for list in trafficport:
            GetRMON(row[4],list[0])

def GetRMON10(n):
    pdhtable = SQLlist10(n)
    for row in pdhtable:
        trafficport = selectmodem(row[8],row[5])
        for list in trafficport:
            GetRMON(row[4],list[0])

def toSQLAll():
    pdhtable = SQLlist()
    for row in pdhtable:
        trafficport = selectmodem(row[8],row[5])
        for list in trafficport:
            toSQL(row[4],list[0])


def GetRMONday(devip,devint,deltaday):
    targetdate = date.today() - timedelta(days=deltaday)
    d2 = targetdate.strftime("%Y%m%d")
    #connect to ftp
    try:
        ftp = FTP(devip)
        ftp.login(user='Admin', passwd='12345678')
        #change to rmon /export/rmon/ directory in the ftp server
        ftp.cwd('/export/rmon/')
        #establishing file naming variable
        filename = '15min-ETH-'+devint+'-'+d2+'.zip'
        filermon = '15min-ETH-'+devint+'-'+d2+'.rmon'
        #create new folder specific to device ip if never been created before
        dir = os.path.join('/home','rto_sbs','sniff',devip)
        if not os.path.exists(dir):
            os.makedirs(dir,0777)
            os.umask(000)
        #establishing file naming variable  
        loc_zip = os.path.join(dir,filename)
        loc_unzip = os.path.join(dir,filermon)
        #copying files from ftp to local
        my_file = open(loc_zip, 'wb')
        ftp.retrbinary('RETR ' + filename,my_file.write)
        my_file.close()
        #unzipping files
        os.chdir(dir)
        if os.path.exists(loc_zip):
            with ZipFile(loc_zip, 'r') as zipObj:
                zipObj.extractall()
        else :
            print ('Folder does not exist')
    except ftplib.all_errors:
        pass

def toSQLday(devip,devint,deltaday):
    #establishing dates
    targetdate = date.today() - timedelta(days=deltaday)
    d2 = targetdate.strftime("%Y%m%d")
    d2edit = targetdate.strftime("%Y-%m-%d")
    #importing to panda dataframe
    filermon = filermon = '15min-ETH-'+devint+'-'+d2+'.rmon'
    loc_unzip = os.path.join('/home','rto_sbs','sniff',devip,filermon)
    try:
        df = pd.read_csv(loc_unzip, skiprows=1)
        #creating custom dataframe to export to sql
        datetime = d2edit+' '+df['Time Stamp']
        Txmbps = df['HCTxetherStatsOctets'] * 8 / 900 / 1000000
        Rxmbps = df['HCRxetherStatsOctets'] * 8 / 900 / 1000000
        rxdrops = df['RxetherStatsDropEvents']
        crc = df['RxetherStatsCRCAlignErrors']
        unknownvid = df['HCRxUnknownVID']
        qdrops = df['HCTxQueue0Discard']
        df.insert(1,'stamp',datetime)
        df.insert(2,'neip',devip)
        df.insert(3,'neint',devint)
        df.insert(4,'tx',Txmbps)
        df.insert(5,'rx',Rxmbps)
        df.insert(6,'rxdrops',rxdrops)
        df.insert(7,'crc',crc)
        df.insert(8,'unknownvid',unknownvid)
        df.insert(9,'qdrops',qdrops)
        #the custom/temporary dataframe
        df2 = df[["stamp","neip","neint","tx","rx","rxdrops","crc","unknownvid","qdrops"]]
        #connecting to MySQL database
        engine = db.create_engine('mysql+pymysql://admin:admin2019@10.35.105.55:3306/sniff')
        #exporting dataframe to sql
        df2.to_sql(name='rmon', con=engine, if_exists='append', index=False)
    except IOError:
        pass

def deleteRMON(devip,devint,deltadays):
    targetdate = date.today() - timedelta(days=deltadays)
    d2 = targetdate.strftime("%Y%m%d")
    filermon = '15min-ETH-'+devint+'-'+d2+'.rmon'
    filezip = '15min-ETH-'+devint+'-'+d2+'.zip'
    dirrmon = os.path.join('/home','rto_sbs','sniff',devip,filermon)
    dirzip = os.path.join('/home','rto_sbs','sniff',devip,filezip)
    if os.path.exists(dirrmon):
        print 'The file '+dirrmon+' exists'
    else:
        print 'The file '+dirrmon+' does not exists'
    if os.path.exists(dirzip):
        print 'The file '+dirzip+' exists'
    else: 
        print 'The file '+dirzip+' does not exists'
