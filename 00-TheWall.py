import mysql.connector

def connect_db():
  config = {
    'user':'imma',
    'password':'imma',
    'host':'localhost',
    'database':'world'
  }
  cnx = mysql.connector.connect(**config)
  return cnx

def close_db(cnx):
  cnx.close()
  
class Message:
    pass

def get_db(cnx):
  cursor = cnx.cursor()
  cursor.execute("SELECT * FROM messages")

  msgs = []

  for(id, inhoud, tijdstip) in cursor:
    print('{} ({}): {}'.format(id, tijdstip, inhoud))
    msg = Message()
    msg.tijdstip = tijdstip
    msg.inhoud = inhoud
    msgs.append(msg)

  cursor.close()

  def get_messages():
    c = connect_db()
    get_db(c)
    close_db(c)

  return msgs