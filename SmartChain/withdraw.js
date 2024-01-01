

let addressInfo = "";
let account = "";
let web3Modal;
let provider;
let selectedAccount;


function init() {
        const providerOptions = {};
        web3Modal = new Web3Modal({
                cacheProvider: false,
                providerOptions,
        });
}


async function connectWallet(evt, id) {
        try {
                provider = await web3Modal.connect();
        } catch (e) {
                Toast.fire({
                        icon: 'error',
                        title: 'Could not get a wallet connection!'
                })
        }

        provider.on("accountsChanged", (accounts) => {
                fetchAccountData(evt, id);
        });

        provider.on("chainChanged", (chainId) => {
                fetchAccountData(evt, id);
        });

        provider.on("networkChanged", (networkId) => {
                fetchAccountData(evt, id);
        });

        await refreshAccountData();
}


async function refreshAccountData() {
        await fetchAccountData(provider);
}


async function fetchAccountData(evt, id) {
        currentChainId = await ethereum.request({ method: 'eth_chainId' });
        // console.log(currentChainId);
        if (currentChainId) {
                if (currentChainId != '0x38') {
                        window.ethereum.request({
                                method: 'wallet_addEthereumChain',
                                params: [{
                                        chainId: '0x38',
                                        chainName: 'Binance Smart Chain',
                                        nativeCurrency: {
                                                name: 'Binance Coin',
                                                symbol: 'BNB',
                                                decimals: 18
                                        },
                                        rpcUrls: ['https://bsc-dataseed.binance.org/'],
                                        blockExplorerUrls: ['https://bscscan.com']
                                }]
                        })
                        return false;
                }
        }

        const web3 = new Web3(provider);
        const chainId = await web3.eth.getChainId();
        const chainData = evmChains.getChain(chainId);
        const accounts = await web3.eth.getAccounts();
        const selectedAccount = accounts[0];
        if (selectedAccount) {
                document.getElementById('wallet_address').innerHTML = selectedAccount;


                var contract = new web3.eth.Contract(contract_abi,
                        contract_address, {
                        from: selectedAccount
                });
                var currency = await contract.methods.symbol().call();
                var balance = await contract.methods.balanceOf(selectedAccount)
                        .call();
                var balance2 = (balance / decimal_number);
                document.getElementById('balance').innerHTML = balance2 + ' ' + currency;
        } else {
                Toast.fire({
                        icon: 'info',
                        title: 'Please select Wallet Address!'
                })
        }
}



async function withdraw(evt, id) {
        const web3 = new Web3(provider);
        const chainId = await web3.eth.getChainId();
        const chainData = evmChains.getChain(chainId);
        const accounts = await web3.eth.getAccounts();
        const selectedAccount = accounts[0];
        // alert(evt.dataset.payable_amount);

        if (selectedAccount) {
                if (selectedAccount) {
                        if (window.ethereum) {
                                (async () => {
                                        var contract = new web3.eth.Contract(contract_abi,
                                                contract_address, {
                                                from: selectedAccount
                                        });
                                        var currency = await contract.methods.symbol().call();
                                        var balance = await contract.methods.balanceOf(selectedAccount)
                                                .call();
                                        var balance2 = (balance / decimal_number);

                                        // const currency = symbol3;

                                        if (currency == 'BUSD') {
                                                var f_amt = evt.dataset.payable_amount;
                                                var tokenValue = 1;
                                                if (tokenValue > 0) {
                                                        if (f_amt >= 1 && f_amt <= 10000) {
                                                                var contract = new web3.eth.Contract(contract_abi,
                                                                        contract_address, {
                                                                        from: selectedAccount
                                                                });
                                                                var balance = await contract.methods.balanceOf(selectedAccount)
                                                                        .call();
                                                                var balance2 = (balance / decimal_number);

                                                                //console.log(balance2);
                                                                var decimals = await contract.methods.decimals().call();

                                                                var final_amount = f_amt;
                                                                //console.log('f' + final_amount);
                                                                var d2 = Number.parseFloat(final_amount).toFixed(decimal);
                                                                final_amount_send = d2.replace('.', "");
                                                                //var final_amount = document.getElementById('amount').value/tokenValue;
                                                        } else {
                                                                final_amount = 0;
                                                        }
                                                } else {
                                                        final_amount = 0;
                                                }


                                        } else {
                                                final_amount = 0;
                                        }
                                        if (final_amount > 0) {
                                                if (balance2 >= final_amount) {

                                                        var wei = web3.utils.toWei(final_amount_send.toString());
                                                        var tokenDeciaml = await contract.methods
                                                                .decimals().call();
                                                        // let eth_hex = web3.utils.toHex(final_amount *
                                                        //     10 **
                                                        //     parseInt(tokenDeciaml));
                                                        contract.methods.transfer(
                                                                evt.dataset.wallet_address,
                                                                final_amount_send).send({
                                                                        //gas : GAS_LIMIT,
                                                                        gasPrice: gasPrice,
                                                                        gasLimit: gasLimit,
                                                                        chain_id: CHAIN_ID
                                                                }).once('transactionHash', function (hash) {

                                                                        Swal.fire({
                                                                                html: "<b>Don't refresh or leave page until your transaction completes, we're not responsible for any money lose if you leave the process!</b>",
                                                                                timerProgressBar: true,
                                                                                allowOutsideClick: false,
                                                                                didOpen: () => {
                                                                                        Swal.showLoading()
                                                                                },
                                                                        });

                                                                }).on('error', function (error) {
                                                                        Toast.fire({
                                                                                icon: 'error',
                                                                                title: "Error " + error.code +
                                                                                        " : " + msg[1]
                                                                        })
                                                                }).then(function (receipt) {
                                                                        if (receipt) {
                                                                                // var f_amt2 = evt.dataset.payable_amount;//Number(document.getElementById('amount').value);
                                                                                // var final_amount2 = (f_amt2 / tokenValue);
                                                                                if (receipt.status == true) {
                                                                                        var element = document.getElementById(id);
                                                                                        var formData = new FormData(element);
                                                                                        formData.append('blockHash', receipt.blockHash);
                                                                                        formData.append('hash', receipt.transactionHash);
                                                                                        formData.append('transaction', JSON.stringify(receipt));

                                                                                        const main_url = base_url + "Admin/Withdraw/approve_withdraw/"
                                                                                        fetch(main_url, {
                                                                                                method: "POST",
                                                                                                headers: {
                                                                                                        "X-Requested-With": "XMLHttpRequest"
                                                                                                },
                                                                                                body: formData,
                                                                                        })
                                                                                                .then(response => response.json())
                                                                                                .then(result => {
                                                                                                        var csrf_length = document
                                                                                                                .getElementsByName(
                                                                                                                        "csrf_test_name").length;
                                                                                                        for (let i = 0; i <
                                                                                                                csrf_length; i++) {
                                                                                                                document.getElementsByName(
                                                                                                                        "csrf_test_name")[i]
                                                                                                                        .value = result.token;
                                                                                                        }
                                                                                                        if (result.success == '1') {
                                                                                                                Toast.fire({
                                                                                                                        icon: 'success',
                                                                                                                        title: result.message
                                                                                                                })
                                                                                                                window.location.href = base_url + '/Admin/Withdraw/Pending';
                                                                                                        } else if (result.success == '2') {
                                                                                                                Toast.fire({
                                                                                                                        icon: 'info',
                                                                                                                        title: result.message
                                                                                                                })
                                                                                                        } else {
                                                                                                                Toast.fire({
                                                                                                                        icon: 'error',
                                                                                                                        title: result.message
                                                                                                                })
                                                                                                        };
                                                                                                });
                                                                                } else {
                                                                                        Toast.fire({
                                                                                                icon: 'error',
                                                                                                title: 'Transaction Failed!'
                                                                                        })
                                                                                }
                                                                        }
                                                                });
                                                        // })
                                                } else {
                                                        Toast.fire({
                                                                icon: 'error',
                                                                title: 'Insufficent Wallet Balance!'
                                                        })
                                                }
                                        } else {
                                                Toast.fire({
                                                        icon: 'info',
                                                        title: 'Invaild Package Selected'
                                                })
                                        }
                                })();

                        }
                }
        }
}


setTimeout(() => {
        init();
        connectWallet();
}, 1e3)


