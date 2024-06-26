<!DOCTYPE html>
<html lang="en" theme-color="default" theme-mode>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <title>tempalte</title>
  <link rel="stylesheet" href="/{$template_catalog}/template/{$themes}/css/common/tdesign.min.css" />
  <link rel="stylesheet" href="/{$template_catalog}/template/{$themes}/css/common/reset.css" />
  <link rel="stylesheet" href="/{$template_catalog}/template/{$themes}/css/update.css">
  <script src="/{$template_catalog}/template/{$themes}/js/common/vue.js"></script>
  <script src="/{$template_catalog}/template/{$themes}/js/common/tdesign.min.js"></script>
  <script>
    Vue.prototype.lang = window.lang
    const url = "/{$template_catalog}/template/{$themes}/"
  </script>
  <script src="/{$template_catalog}/template/{$themes}/js/common/lang.js"></script>
  <script src="/{$template_catalog}/template/{$themes}/js/common/moment.min.js"></script>
  <script src="/{$template_catalog}/template/{$themes}/js/common/layout.js"></script>
</head>

<body>
  <!-- loading -->
  <div id="loading">
    <div class="box">
      <div></div>
      <div></div>
    </div>
  </div>
  <div class="update" v-cloak>
    <div class="iu">
      <img class="iu-logo" src="/{$template_catalog}/template/{$themes}/img/logo.png">
      <div class="iu-card">
        <div class="iu-card-title">
          欢迎使用智简魔方业务管理系统
        </div>
        <div class="iu-card-main">
          <div class="main-left">
            <div class="left-item" :class="item.id===activeId?'menu-active':''" v-for="item in menu" :key="item.id">
              <img class="icon-l" src="/{$template_catalog}/template/{$themes}/img/iu/iu-menu-left.png">
              <img class="icon-r" :src="item.icon">
              <span class="item-text">{{item.text}}</span>
            </div>
          </div>
          <div class="main-right">
            <!-- 升级检测开始 -->
            <div class="r-content" v-show="!isBegin">
              <div class="content-title">升级检测</div>
              <div class="content-main content-warning">
                <img class="warning-img" src="/{$template_catalog}/template/{$themes}/img/iu/warning.png">
                <div class="warning-text">
                  {{versionData.last_version_check}}
                </div>
                <div class="version">
                  <div class="version-item">
                    <div class="item-l">当前版本:</div>
                    <div class="item-r">{{versionData.version}}</div>
                  </div>
                  <div class="version-item">
                    <div class="item-l">更新包版本:</div>
                    <div class="item-r">{{versionData.last_version}}</div>
                  </div>
                </div>
                <t-button class="back-btn" @click="goBack">返回</t-button>
              </div>
            </div>
            <!-- 升级检测结束 -->
            <!-- 欢迎页开始 -->
            <div v-if="isBegin" class="r-content" v-show="activeId===1">
              <div class="content-title">更新须知</div>
              <div class="content-main">
                <div class="version">
                  <div class="version-item">
                    <div class="v-label">当前版本:</div>
                    <div class="v-value">{{versionData.version}}</div>
                  </div>
                  <div class="version-item">
                    <div class="v-label">更新包版本:</div>
                    <div class="v-value">{{versionData.last_version}}</div>
                  </div>
                </div>
                <div class="read">
                  <div class="read-label">本次更新必读：</div>
                  <div class="read-ontent" v-html="contentData.warning"></div>
                </div>
                <div class="read">
                  <div class="read-label">更新内容：</div>
                  <div class="read-ontent" v-html="contentData.content"></div>
                </div>

                <t-button class="btn-begin" @click="begin">开始安装</t-button>
              </div>
            </div>
            <!-- 欢迎页结束 -->
            <!-- 覆盖文件开始 -->
            <div class="r-content" v-show="activeId===2">
              <div class="content-title">覆盖文件</div>
              <div class="content-main">
                <div class="cover">
                  <img class="cover-img" src="/{$template_catalog}/template/{$themes}/img/iu/cover.png">
                  <div class="dowm">
                    <div class="dowm-progress-text"> {{updateData.msg +'...(' + updateData.progress + ')'}}</div>
                    <div class="down-progress">
                      <div :style="'width:'+ updateData.progress" class="down-progress-success"></div>
                    </div>
                    <div class="down-text">
                      {{updateData.file_log?updateData.file_log:'正在...'}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 覆盖文件结束 -->

            <!-- 数据库更新开始 -->
            <div class="r-content" v-show="activeId===3">
              <div class="content-title">数据库更新</div>
              <div class="content-main">
                <div class="db">
                  <div class="db-text">正在执行数据库更新：</div>
                  <div class="db-content">
                    {{updateData.mysql_log?updateData.mysql_log:''}}
                  </div>
                </div>
              </div>
            </div>
            <!-- 数据库更新结束 -->
            <!-- 执行文件开始 -->
            <div class="r-content" v-show="activeId===4">
              <div class="content-title">执行文件</div>
              <div class="content-main">
                <div class="db">
                  <div class="db-text">正在执行升级程序</div>
                  <div class="db-content">
                    {{updateData.php_exec_log?updateData.php_exec_log:''}}
                  </div>
                </div>
              </div>
            </div>
            <!-- 执行文件结束 -->
            <!-- 升级完成开始 -->
            <div class="r-content" v-show="activeId===5">
              <div class="content-title">升级完成</div>
              <div class="content-main success-main">
                <img class="success-img" src="/{$template_catalog}/template/{$themes}/img/iu/success.png">
                <span class="success-tit">升级已完成</span>
                <span class="successs-text">
                  升级已完成，系统将会自动删除更新包，如删除失败，请人工删除
                </span>
                <span class="successs-text">
                  为了能正常使用，建议访问后台后，强制刷新浏览器并退出账号重新登录
                </span>
                <span class="successs-text">Windows快捷键：Ctrl+F5</span>
                <span class="successs-text">Mac快捷键：Command+Shift+R或者Command+Option+R(Safari,Opera)</span>
                <t-button class="success-btn" @click="toAdmin">访问后台</t-button>
              </div>
            </div>
            <!-- 升级完成结束 -->
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- =======页面独有======= -->
  <script src="/{$template_catalog}/template/{$themes}/api/common.js"></script>
  <script src="/{$template_catalog}/template/{$themes}/api/update.js"></script>
  <script src="/{$template_catalog}/template/{$themes}/js/update.js"></script>
  <!-- =======公共======= -->
  <script src="/{$template_catalog}/template/{$themes}/js/common/axios.min.js"></script>
  <script src="/{$template_catalog}/template/{$themes}/utils/request.js"></script>
</body>

</html>
