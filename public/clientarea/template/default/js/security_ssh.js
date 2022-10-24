(function (window, undefined) {
    var old_onload = window.onload
    window.onload = function () {
        const template = document.getElementsByClassName('template')[0]
        Vue.prototype.lang = window.lang
        new Vue({
            components: {
                asideMenu,
                topMenu,
                pagination,
            },
            created() {
                this.getCommonData()
            },
            mounted() {
                this.getSshList()
            },
            updated() {
                // // 关闭loading
                // document.getElementById('mainLoading').style.display = 'none';
                // document.getElementsByClassName('template')[0].style.display = 'block'
            },
            destroyed() {

            },
            data() {
                return {
                    params: {
                        page: 1,
                        limit: 10,
                        pageSizes: [10, 20],
                        total: 200,
                        orderby: 'id',
                        sort: 'desc',
                        keywords: '',
                    },
                    commonData: {},
                    activeName: "2",
                    loading: false,
                    dataList: [],
                    isShowDel: false,
                    delName: '',
                    delId: 0,
                    isShowCj: false,
                    cjData: {
                        name: "",
                        public_key: ""
                    },
                    errText: "",
                    isShowEdit: false,
                    editData: {
                        id: 0,
                        name: '',
                        public_key: ''
                    }
                }
            },
            filters: {
                formateTime(time) {
                    if (time && time !== 0) {
                        return formateDate(time * 1000)
                    } else {
                        return "--"
                    }
                }
            },
            methods: {
                // 获取通用配置
                getCommonData() {
                    getCommon().then(res => {
                        if (res.data.status === 200) {
                            this.commonData = res.data.data
                            localStorage.setItem('common_set_before', JSON.stringify(res.data.data))
                            document.title = this.commonData.website_name + '-工单系统'
                        }
                    })
                },
                // 每页展示数改变
                sizeChange(e) {
                    this.params.limit = e
                    this.params.page = 1
                    // 获取列表
                },
                // 当前页改变
                currentChange(e) {
                    this.params.page = e
                },
                inputChange() {
                    this.params.page = 1
                    this.getSshList()
                },
                handleClick() {
                    console.log(this.activeName);
                    if (this.activeName == 1) {
                        location.href = "security.html"
                    }
                    if (this.activeName == 3) {
                        location.href = "security_log.html"
                    }
                },
                showCreateSsh() {
                    this.isShowCj = true
                    this.errText = ""
                    this.cjData = {
                        name: "",
                        public_key: ""
                    }
                    console.log("sss");
                },
                getSshList() {
                    this.loading = true
                    sshList(this.params).then(res => {
                        if (res.data.status === 200) {
                            this.dataList = res.data.data.list
                            this.params.total = res.data.data.count
                        }
                        this.loading = false
                    }).catch(err => {
                        this.loading = false
                    })
                },
                deleteItem(row) {
                    this.delName = row.name
                    this.delId = row.id
                    this.isShowDel = true
                },
                editItem(row) {
                    this.errText = ""
                    this.editData.id = row.id
                    this.editData.name = row.name
                    this.editData.public_key = row.public_key
                    this.isShowEdit = true
                },
                editClose() {
                    this.isShowEdit = false
                },
                editSub() {
                    let isPass = true
                    const data = this.editData

                    if (!data.name) {
                        this.errText = "请输入修改后的名称"
                        isPass = false
                        return false
                    }
                    if (!data.public_key) {
                        this.errText = "请输入修改后的公钥"
                        isPass = false
                        return false
                    }

                    if (isPass = true) {
                        this.errText = ""
                        const params = {
                            ...data
                        }

                        editSsh(params).then(res => {
                            if (res.data.status === 200) {
                                this.$message.success(res.data.msg)
                                this.getSshList()
                                this.isShowEdit = false
                            }
                        }).catch(error => {
                            this.errText = error.data.msg
                        })
                    }
                },
                // 取消删除
                delClose() {
                    this.isShowDel = false
                },
                // 确认删除
                delSub() {
                    this.isShowDel = false
                    const params = {
                        id: this.delId
                    }
                    delSsh(params).then(res => {
                        if (res.data.status === 200) {
                            this.isShowDel = false
                            this.$message.success(res.data.msg)
                            this.getSshList()
                        }
                    }).catch(err => {
                        this.$message.error(err.data.msg)
                    })
                },
                cjSub() {
                    const data = this.cjData
                    let isPass = true

                    if (!data.name) {
                        this.errText = "请输入名称"
                        isPass = false
                        return false
                    }
                    if (!data.public_key) {
                        this.errText = "请输入公钥"
                        isPass = false
                        return false
                    }

                    if (isPass) {
                        this.errText = ""
                        const params = {
                            ...data
                        }
                        createSsh(params).then(res => {
                            if (res.data.status === 200) {
                                this.$message.success(res.data.msg)
                                this.isShowCj = false
                                this.getSshList()
                            }
                        }).catch(err => {
                            this.errText = err.data.msg
                        })
                    }
                },
                cjClose() {
                    this.isShowCj = false
                },

            },

        }).$mount(template)
        typeof old_onload == 'function' && old_onload()
    };
})(window);
