WifiShiftNotificationTools [![Build Status](https://travis-ci.org/Skobayashi/WifiShiftNotificationTools.svg?branch=master)](https://travis-ci.org/Skobayashi/WifiShiftNotificationTools) [![Coverage Status](https://coveralls.io/repos/Skobayashi/WifiShiftNotificationTools/badge.png?branch=master)](https://coveralls.io/r/Skobayashi/WifiShiftNotificationTools?branch=master)
====

## Description
Wifiパスワード変更業務に関する通知メールツール。

## Requirement

PHP >= 5.6

## Usage
事前通知メールの送付。

```
$ ./shift SendAdvanceNoticeMail
```

当番通知メールの送付。

```
$ ./shift SendWifiShiftNoticeMail
```

パスワード変更未完了通知メールの送付。

```
$ ./shift SendReNotificationWifiShiftMail
```


## Install

```
$ composer.phar install
```

## Licence

[MIT](https://github.com/Skobayashi/WifiShiftNotificationTools/blob/master/LICENCE)

## Author

[Skobayshi](https://github.com/Skobayashi)
