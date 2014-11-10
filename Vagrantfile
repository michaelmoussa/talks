require 'yaml'

Vagrant.require_version '>= 1.6.0'

Vagrant.configure('2') do |config|
  config.vm.define :web do |web|
    web.vm.host_name = "web"
    web.vm.network :private_network, ip: "192.168.133.71"
    web.vm.provision :shell, :path => 'provision/web/install.sh'
  end

  config.vm.define :worker do |worker|
    worker.vm.host_name = "worker"
    worker.vm.network :private_network, ip: "192.168.133.72"
    worker.vm.provision :shell, :path => 'provision/worker/install.sh'
  end

  config.vm.box     = "puphpet/ubuntu1404-x64"
  config.vm.box_url = "puphpet/ubuntu1404-x64"

  config.vm.synced_folder "./", "/vagrant",
    group: 'www-data', owner: 'www-data', mount_options: ['dmode=775', 'fmode=764']

  config.vm.provider :virtualbox do |virtualbox|
    virtualbox.customize ['modifyvm', :id, '--cpus', "1"]
  end

  config.vm.provider 'vmware_fusion' do |v|
    v.vmx['numvcpus'] = "1"
  end
end
