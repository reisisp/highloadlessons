$bd_count = 2

Vagrant.configure("2") do |config|
  config.vm.provider "virtualbox" do |v|
	v.gui = false
	v.memory = "2048"
	v.cpus = 1
	v.check_guest_additions = false
  config.vm.box_check_update = false
  config.vm.box = "centos/7"
  end
  
  (1..$bd_count).each do |i|
		config.vm.define "bd#{i}" do |bd|
			bd.vm.network "forwarded_port", guest: 80, host: "808#{i}", id: "HTTP", host_ip: "127.0.0.1"
			bd.vm.network "forwarded_port", guest: 3306, host: "330#{i}", id: "MySQL", host_ip: "127.0.0.1"
			bd.vm.hostname = "bd#{i}"
			bd.vm.base_mac = "0800278493D#{i}"
			bd.vm.network "private_network", ip: "192.168.1.#{i}", virtualbox__intnet: "NatNetwork"
		end
	end
	
	config.vm.provision "shell", inline: "sudo yum install -y net-tools"
		
	config.vm.provision "shell", inline: "sudo yum install -y epel-release"
	config.vm.provision "shell", inline: "sudo rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm"
	config.vm.provision "shell", inline: "sudo yum install -y nginx nano"
	config.vm.provision "shell", inline: "sudo yum install -y php72 php72-php-fpm php72-php-pecl-xdebug"
		
	config.vm.provision "shell", inline: "sudo yum install -y composer"
	config.vm.provision "shell", inline: "sudo yum install -y zip unzip"
		
	config.vm.provision "shell", inline: "sudo yum install -y https://repo.percona.com/yum/percona-release-latest.noarch.rpm"
	config.vm.provision "shell", inline: "sudo percona-release setup ps80"
	config.vm.provision "shell", inline: "sudo yum install -y percona-server-server"
		
	config.vm.provision "shell", inline: "sed -i '/PasswordAuthentication no/c PasswordAuthentication yes' /etc/ssh/sshd_config"
	config.vm.provision "shell", inline: "service sshd restart"
		
	config.vm.provision "shell", inline: "setenforce 0"
	config.vm.provision "shell", inline: "sed -i '/SELINUX=enforcing/c SELINUX=disabled' /etc/selinux/config"
		
	config.vm.provision "shell", inline: "mkdir -p /var/www/mysite.local"
	config.vm.provision "shell", inline: "chown -R vagrant:nginx /var/www/"
	config.vm.provision "shell", inline: "chmod -R 0775 /var/www/"
	config.vm.provision "shell", inline: "ln -sf /usr/bin/php72 /usr/bin/php"
		
	config.vm.provision "file", source: "www.conf", destination: "/tmp/www.conf"
	config.vm.provision "shell", inline: "sudo mv /tmp/www.conf /etc/opt/remi/php72/php-fpm.d/www.conf"
		
	config.vm.provision "file", source: "mysite.local.conf", destination: "/tmp/mysite.local.conf"
	config.vm.provision "shell", inline: "sudo mv /tmp/mysite.local.conf /etc/nginx/conf.d/mysite.local.conf"
		
	config.vm.provision "file", source: "nginx.conf", destination: "/tmp/nginx.conf"
	config.vm.provision "shell", inline: "sudo mv /tmp/nginx.conf /etc/nginx/nginx.conf"
		
	config.vm.provision "shell", inline: "sudo nginx -t"
		
	config.vm.provision "file", source: "index.php", destination: "/tmp/index.php"
	config.vm.provision "shell", inline: "sudo mv /tmp/index.php /var/www/mysite.local/index.php"

end
