Setup the Vault environment (in Windows)
==============
Open a command prompt

	set VAULT_ADDR=http://127.0.0.1:8200
	cd {vault_installdir}
	vault server -dev

This starts Vault in development mode.
Scroll up and locate the generated Root Token
Add this to the VAULT_TOKEN .env variable
