FROM python:3.9.2-slim-buster

WORKDIR /app

COPY simulator/ .

RUN pip install --no-cache-dir -r requirements.txt

# seamless creation of the results.txt file with details after calling the API (uncomment below)
# CMD [ "python", "simulator.py" ]
