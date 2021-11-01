# テーブル構成

### families(家族)

#### マスタ

|物理名|論理名|型|
|----|----|----|
|name|名前|string|

### payees(支払先(病院・薬局))

#### マスタ

|物理名|論理名|型|コメント|
|----|----|----|----|
|name|名前|string|
|is_hospital|病院か薬局かのフラグ|boolean|

### insurance_companies(保険会社)

#### マスタ

|物理名|論理名|型|コメント|
|----|----|----|----|
|name|保険会社名|string|

### payments(支払情報)

#### トランザクション

|物理名|論理名|型|コメント|default|
|----|----|----|----|----|
|paid_at|支払日|timestamp|
|payee_id|支払先|unsignedBigInteger|
|is_deducted|控除されるかどうか|boolean|true: 3割負担, false: 10割負担
|is_own_expensed|自費か、保険からの出費か|boolean|true: 自費, false: 保険|自費
|insurance_company_id|保険会社|unsignedBigInteger
|price|出費額|decimal|負担額
|remarks|備考|string
