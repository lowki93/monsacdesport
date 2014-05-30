set :domain, "195.154.87.49"
set :symfony_env_prod, "prod"

set :deploy_to, "/var/www/monsacdesport"

role :web, domain
role :app, domain
role :db, domain, :primary => true