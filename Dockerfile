FROM csunmetalab/environment:base

# Install basic utilities
RUN apt-get update && apt-get install -y \
    curl \ 
    git \
    zip \
    apt-transport-https \
# Add yarn sources
  && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
# Install yarn sqlite3
  && apt-get update && apt-get install -y \
    yarn \ 
    sqlite3 