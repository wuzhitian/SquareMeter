# SquareMeter  

## Standard Documents
### Dictionary
| 中文名 | 英文名 | 缩写 |
| --- | --- | --- |
| 公司名称 | SquareMeter BlockChain Tech Inc. | SMBC Tech Inc. |
| 平方米私有链 | SquareMeter BlockChain | SMBC |
| 项目名称 | SquareMeter | SM |
| 主域名 | squaremeter.link ||
| 官网域名 | www.squaremeter.link ||
| WebApp域名 | app.squaremeter.link ||
| 区块链接口api域名 | api_smbc.squaremeter.link |
| 平台api域名 | api_platform.squaremeter.link ||
| 交易所api域名 | api_exchange.squaremeter.link ||
| 抵押所api域名 | api_pawnshop.squaremeter.link ||
| 产品地产 | Industrial Real Estate | IRE |

## Software Structure


### SMBC
私有链部分，基于以太坊

##### AsyncTaskClient
    异步任务管理的客户端

### SMBCMiddleTier
私有链部分与平台部分的接口封装与调度服务

##### AsyncTaskServer
    将调用链上业务示为异步任务，实现异步任务管理的服务端
    
##### BalanceService
    负载均衡服务

### SMPlatform
平台部分，微服务架构

##### InterfaceService
    接口层服务
    
##### DataResourceService
    数据资源服务，唯一连接数据库的服务，连接池服务，封装redis层，提供内存缓存与持久化能力
    
##### DispatcherService
    微服务分发调度服务，任何微服务都必须从这里调用，由http_api形式对外，对内可多种形态

##### AccountService
    账户服务，处理SMBC地址与实名账户的一一对应关系、保管私钥、管理授权

##### WebService
    Web发布服务，考虑是用nginx或者自己搭建的web服务

##### ToolService
    工具类服务，实现如自动化测试、回溯等开发级功能

##### CommonService
    公共服务，实现如充值、提现、实名认证、短信等第三方调用对接

##### EstateService
    资产服务，实现如购置资产、清算资产、红利派发等业务
    
##### TradeService
    交易服务，为交易所与质押所的具体实现提供原子操作与记录，包括资产派息行为

### SMExchange
交易所部分

##### OrderService
##### TradeService

### SMPawnshop
质押所部分

##### OrderService
##### TradeService