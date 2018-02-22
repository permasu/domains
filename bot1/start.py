BOT_TOKEN="537927705:AAGkSUNLBo-sCx-rWKSkt6110jEknqVhefI"
URL = "https://api.telegram.org/bot%s/" % BOT_TOKEN
MyURL = "https://example.com/hook"
import requests 
import tornado
import tornado.web

from handler import Handler
import signal


import sys
api = requests.Session()
application = tornado.web.Application([
    (r"/", Handler),
])

if __name__ == '__main__':
    signal.signal(signal.SIGTERM, signal_handler)
    try:
        set_hook = api.get(URL + "setWebhook?url=%s" % MyURL)
        if set_hook.status_code != 200:
            logging.error("Can't set hook: %s. Quit." % set_hook.text)
            exit(1)
        application.listen(8888)
        tornado.ioloop.IOLoop.current().start()
    except KeyboardInterrupt:
        signal_term_handler(signal.SIGTERM, None)