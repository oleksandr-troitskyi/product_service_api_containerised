# Service API

## Set Up
First of all, you need Docker.
Please run `make bootstrap` command at the root directory of this archive. This will install all composer dependencies and run docker containers.  
Then, run `make import-csv`. This will fill DB with data from CSV files.  
You although need to edit your **hosts** file - add `service_api.loc 127.0.0.1` line there.  
After that, you are free to use `http://service_api.loc`. You will see OK message.  
Endpoints are the same as in assignment file.

## Clarifications
- I didn't use hashing for passwords. They are stored in DB as is. Way to improve - hash them on import and then check hashes.
- Following KISS and YAGNI principles, I didn't overcomplicated code base as there is very simple logic. So all login mostly contained at Controllers. We can use Service classes and migrate logic there.
- To minimize time, I didn't fully covered project by Functional tests, as well as did not created mocks for table connections and so on. That being said, tests work directly with "production" tables.