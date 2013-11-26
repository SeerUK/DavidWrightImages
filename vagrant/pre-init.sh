#!/bin/bash

PUPPET_DIR=/etc/puppet/
VAGRANT_DIR=/vagrant/

# Setup Puppet Librarian

if [ "$(gem search -i librarian-puppet)" = "false" ]; then
    gem install librarian-puppet
fi

cd $VAGRANT_DIR
librarian-puppet install


# Setup Hiera

if [ "$(gem search -i deep_merge)" = "false" ]; then
    # deep merge gem required for deeper hiera_hash merging
    # http://docs.puppetlabs.com/hiera/1/lookup_types.html#deep-merging-in-hiera--120
    gem install deep_merge
fi

if [ ! -d "$PUPPET_DIR" ]; then
    mkdir -p $PUPPET_DIR
fi

cp /vagrant/hiera.yaml $PUPPET_DIR

