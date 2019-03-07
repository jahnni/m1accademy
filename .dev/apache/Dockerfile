FROM centos:7
RUN yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm http://rpms.remirepo.net/enterprise/remi-release-7.rpm yum-utils
RUN yum-config-manager --enable remi-php70
RUN yum -y install \
   PyYAML \
   acl \
   apr \
   apr-util \
   audit-libs \
   bash \
   bind-license \
   binutils \
   bzip2-libs \
   coreutils \
   curl \
   gawk \
   gnupg2 \
   grep \
   gzip \
   hostname \
   httpd \
   httpd-tools \
   iputils \
   jpegoptim \
   libmemcached \
   libpng \
   libpwquality \
   libtiff \
   libxml2 \
   libzip5 \
   mod_ssl \
   openldap \
   openssl \
   openssl-libs \
   pam \
   passwd \
   php \
   php-PsrLog \
   php-bcmath \
   php-fedora-autoloader \
   php-gd \
   php-intl \
   php-json \
   php-jsonlint \
   php-justinrainbow-json-schema5 \
   php-ldap \
   php-mbstring \
   php-mcrypt \
   php-mysqlnd \
   php-opcache \
   php-paragonie-random-compat \
   php-password-compat \
   php-pdo \
   php-pear \
   php-pecl-apfd \
   php-pecl-http \
   php-pecl-igbinary \
   php-pecl-json-post \
   php-pecl-memcache \
   php-pecl-memcached \
   php-pecl-msgpack \
   php-pecl-propro \
   php-pecl-raphf \
   php-pecl-redis \
   php-pecl-xdebug \
   php-pecl-imagick \
   php-pecl-zip \
   php-process \
   php-seld-cli-prompt \
   php-seld-phar-utils \
   php-soap \
   php-symfony-browser-kit \
   php-symfony-class-loader \
   php-symfony-common \
   php-symfony-config \
   php-symfony-console \
   php-symfony-css-selector \
   php-symfony-debug \
   php-symfony-dependency-injection \
   php-symfony-dom-crawler \
   php-symfony-event-dispatcher \
   php-symfony-expression-language \
   php-symfony-filesystem \
   php-symfony-finder \
   php-symfony-http-foundation \
   php-symfony-http-kernel \
   php-symfony-polyfill \
   php-symfony-process \
   php-symfony-var-dumper \
   php-symfony-yaml \
   php-xml \
   php70-php-common \
   php70-php-json \
   php70-php-mysqlnd \
   php70-php-pdo \
   php70-php-pecl-mysql \
   php70-runtime \
   php-pdo-dblib \
   php70-php-pdo-dblib \
   pngcrush \
   readline \
   sed \
   setools-libs \
   sqlite \
   tar \
   tcl \
   vim-minimal \
   whitch \
   ssmtp \
   xz; \
   yum clean all ;  rm -rf /var/cache/yum
COPY php.d/ /etc/php.d/
COPY httpd /etc/httpd/
RUN rm -fr /var/log/httpd/*log; ln -s /dev/stdout /var/log/access_log; ln -s /dev/stderr /var/log/error_log; 
RUN sed -i 's_^ErrorLog.*_ErrorLog /dev/stderr_' `find /etc/httpd/ -type f ` && rm /etc/httpd/conf.d/ssl.conf
ADD entry.sh /usr/local/bin/entry.sh
RUN chmod +x /usr/local/bin/entry.sh
RUN groupadd --gid 10002 GG_Development
RUN useradd -ms /bin/bash --uid 10881 --gid 10002 tbd_deploy
COPY fail_index.html /usr/share/httpd/noindex/index.html
CMD /usr/local/bin/entry.sh
