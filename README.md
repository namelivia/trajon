# Trajon

Just an example image gallery using Laravel + S3 + Pomerium Proxy for authentication.

## Usage
Clone this repository.

Run `scripts/generate_certificates`, this will generate 2 certificates and private keys on the `certs` folder.

Then run `scripts/get_signing_key` to get the signing key and copy it. You can do it all at once by doing:
`scripts/get_signing_key|xclip -selection clipboard`

Now use the example pomerium config as a template with `cp pomerium/config.yaml.example pomerium/config.yaml`.

Next fill in the pomerium config file with [your IdP values](https://www.pomerium.io/docs/identity-providers/), and on `signing_key` paste the key we got before.

For a cookie secret use `scripts/generate_cookie_secret` to get the a new cookie secret key and copy it.
You can do it all at once by doing: `scripts/generate_cookie_secret|xclip -selection clipboard`

Also on `allowed_users` add the account email you'll be logging in with.

Run `docker-compose up --build`.

And visit on your browser `https://trajon.localhost.pomerium.io`, you may get warnings as the certificates are 
self-signed, click on accept the risks and continue.
