<?php

return [
	'title' => 'لوحة التحكم',
	'logout' => 'تسجيل الخروج',
	'store' => 'العودة للمتجر',
	'profile' => 'تعديل الحساب',
	'groups_and_privileges' => 'التراخيص و المجموعات',
	'control' => 'التحكم',
	'no_record' => 'لم يتم العثور على سجلات مطابقة',
	'save' => 'حفظ',
	'search' => 'بحث',

	'permissions' => [
		'title' => 'التراخيص',
		'name' => 'أسم الترخيص',		
		'description' => 'وصف الترخيص',
		'create' => 'ترخيص جديد',
		'create_success' => 'تم انشاء الترخيص بنجاح',
	],
	'roles' => [
		'title' => 'المجموعات',
		'name' => 'أسم المجموعة',		
		'description' => 'وصف المجموعة',
		'create' => 'مجموعة جديدة',
		'edit' => 'تعديل مجموعة',
		'create_success' => 'تم انشاء المجموعة بنجاح',
		'edit_success' => 'تم تعديل المجموعة بنجاح',
		'delete_success' => 'تم حذف المجموعة بنجاح',
		'permissions' => 'التراخيص',
	],
	'users' => [
		'title' => 'المستخدمين',
		'first_name' => 'الأسم الاول',		
		'last_name' => 'أسم العائلة',		
		'email' => 'البريد الالكترونى',		
		'group' => 'المجموعة',		
		'select_group' => 'أختر المجموعة',		
		'password' => 'كلمة المرور',		
		'password_confirm' => 'تأكيد كلمة المرور',		
		'image' => 'صورة المستخدم',		
		'address' => 'العنوان',		
		'age' => 'العمر',		
		'gender' => 'النوع',		
		'male' => 'ذكر',		
		'female' => 'انثى',		
		'last_login' => 'أخر تسجيل دخول',		
		'create' => 'مستخدم جديد',
		'edit' => 'تعديل المستخدم',
		'create_success' => 'تم انشاء مستخدم جديد بنجاح',
		'edit_success' => 'تم تعديل المستخدم بنجاح',
		'delete_success' => 'تم حذف المستخدم بنجاح',
	],
	'categories' => [
		'title' => 'الأقسام',
		'name' => 'أسم القسم',
		'name_en' => 'أسم القسم بالأنجليزية',		
		'name_ar' => 'أسم القسم بالعربية',		
		'children_count' => 'الأقسام الفرعية',		
		'parent' => 'القسم الرئيسى',		
		'parent_cat' => 'أختر القسم الرئيسى',		
		'create' => 'قسم جديد',
		'edit' => 'تعديل القسم',
		'create_success' => 'تم انشاء القسم بنجاح',
		'edit_success' => 'تم تعديل القسم بنجاح',
		'delete_success' => 'تم حذف القسم بنجاح',
	],		
	'stores' => [
		'title' => 'المخازن',
		'name' => 'أسم المخزن',		
		'address' => 'عنوان المخزن',		
		'supplier' => 'المورد',		
		'choose_supplier' => 'أختر المورد',		
		'products_count' => 'عدد المنتجات',		
		'create' => 'مخزن جديد',
		'edit' => 'تعديل المخزن',
		'create_success' => 'تم انشاء المخزن بنجاح',
		'edit_success' => 'تم تعديل المخزن بنجاح',
		'delete_success' => 'تم حذف المخزن بنجاح',
	],
	'products' => [
		'title' => 'المنتجات',
		'barcode' => 'الكود',
		'name' => 'أسم المنتج',
		'name_en' => 'أسم المنتج بالأنجليزية',
		'name_ar' => 'أسم المنتج بالعربية',
		'buy_price' => 'سعر الشراء',
		'sell_price' => 'سعر البيع',
		'discount' => 'الخصم (%)',
		'offer' => 'العرض',
		'weight' => 'الوزن',
		'images' => 'صور المنتج',
		'stores' => 'المخازن',
		'quantity' => 'الكمية',
		'color' => 'اللون',
		'status' => 'الحالة',
		'description_en' => 'وصف المنتج بالأنجليزية',
		'description_ar' => 'وصف المنتج بالعربية',
		'category' => 'القسم',
		'select_offer' => 'أختر العرض',
		'select_category' => 'أختر القسم',
		'owner' => 'التاجر',
		'select_owner' => 'أختر التاجر',
		'quantity' => 'الكمية',
		'store' => 'المخزن',
		'create' => 'منتج جديد',
		'edit' => 'تعديل المنتج',
		'create_success' => 'تم انشاء المنتج بنجاح',
		'edit_success' => 'تم تعديل المنتج بنجاح',
		'delete_success' => 'تم حذف المنتج بنجاح',
	],
	'images' => [
		'delete_success' => 'تم حذف الصورة بنجاح',
	],
	'orders' => [
		'title' => 'الطلبات',
		'created_at' => 'تاريخ الطلب',
		'status' => 'الحالة',
		'total_price' => 'أجمالى السعر',
		'payment_pending' => 'أنتظار الدفع',
		'preparing' =>  'جارى التحضير',
		'shipping' => 'جارى الشحن',
		'completed' => 'أكتمل',
		'error' => 'خطأ',
		'create' => 'طلب جديد',
		'edit' => 'تعديل الطلب',
		'create_success' => 'تم انشاء الطلب بنجاح',
		'edit_success' => 'تم تعديل الطلب بنجاح',
		'delete_success' => 'تم حذف الطلب بنجاح',
	],
	'slideshow' => [
		'title' => 'الأعلانات',
		'title_ar' => 'أسم الأعلان بالعربية',		
		'title_en' => 'أسم الأعلان بالانجليزية',		
		'link' => 'مسار الأعلان',
		'image' => 'صورة الأعلان',
		'create' => 'أعلان جديد',
		'edit' => 'تعديل الأعلان',
		'create_success' => 'تم انشاء الأعلان بنجاح',
		'edit_success' => 'تم تعديل الأعلان بنجاح',
		'delete_success' => 'تم حذف الأعلان بنجاح',
	],
	'offers' => [
		'title' => 'العروض',
		'name_ar' => 'أسم العرض بالعربية',		
		'name_en' => 'أسم العرض بالانجليزية',		
		'products_count' => 'عدد المنتجات',
		'image' => 'صورة العرض',
		'create' => 'عرض جديد',
		'edit' => 'تعديل العرض',
		'create_success' => 'تم انشاء العرض بنجاح',
		'edit_success' => 'تم تعديل العرض بنجاح',
		'delete_success' => 'تم حذف العرض بنجاح',
	]
];