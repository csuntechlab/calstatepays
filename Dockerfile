FROM csunmetalab/environment:base

# Install basic utilities
RUN apt-get update && apt-get install -y \
    git \
    zip \
# Add yarn sources
  && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
  && add-apt-repository -y ppa:deadsnakes/ppa \
# Install yarn, python3.6 and librariers
  && apt-get update && apt-get install -y \
    yarn \ 
    python3.6 \
    python3-pip \
  && python3.6 -m pip install pandas \
  && python3.6 -m pip install simplejson \