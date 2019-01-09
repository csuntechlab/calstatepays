FROM csunmetalab/environment:base

# Install basic utilities
RUN apt-get update && apt-get install -y \
    git \
    zip \
# Add yarn and required packagessources
  && curl -sL https://deb.nodesource.com/setup_10.x | bash - \
  && apt-get install -y nodejs \
  && npm config set scripts-prepend-node-path true \
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
# Clean image
  && apt-get clean && apt-get autoremove && rm -rf /var/lib/apt/lists/* && rm -rf /etc/apt/sources.list.d/*