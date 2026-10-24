<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // 1 — ثقافة عامة
            [
                'question' => 'في أي سنة سقط جدار برلين؟',
                'answers' => [
                    ['text' => '1995', 'is_correct' => false],
                    ['text' => '2001', 'is_correct' => false],
                    ['text' => '1989', 'is_correct' => true],
                    ['text' => '1979', 'is_correct' => false],
                ],
            ],

            // 2 — ثقافة عامة
            [
                'question' => 'ما المضيق الذي يفصل المغرب عن إسبانيا؟',
                'answers' => [
                    ['text' => 'مضيق البوسفور', 'is_correct' => false],
                    ['text' => 'مضيق هرمز', 'is_correct' => false],
                    ['text' => 'مضيق جبل طارق', 'is_correct' => true],
                    ['text' => 'مضيق باب المندب', 'is_correct' => false],
                ],
            ],

            // 3 — ثقافة عامة
            [
                'question' => 'ما العنصر الكيميائي الذي يحمل الرمز Fe؟',
                'answers' => [
                    ['text' => 'الفلور', 'is_correct' => false],
                    ['text' => 'الزنك', 'is_correct' => false],
                    ['text' => 'الفضة', 'is_correct' => false],
                    ['text' => 'الحديد', 'is_correct' => true],
                ],
            ],

            // 4 — ثقافة عامة
            [
                'question' => 'من ألّف كتاب المقدمة الشهير؟',
                'answers' => [
                    ['text' => 'ابن خلدون', 'is_correct' => true],
                    ['text' => 'الجاحظ', 'is_correct' => false],
                    ['text' => 'ابن رشد', 'is_correct' => false],
                    ['text' => 'ابن سينا', 'is_correct' => false],
                ],
            ],

            // 5 — ثقافة عامة
            [
                'question' => 'في أي بلد تقع مدينة البتراء الأثرية؟',
                'answers' => [
                    ['text' => 'سوريا', 'is_correct' => false],
                    ['text' => 'الأردن', 'is_correct' => true],
                    ['text' => 'العراق', 'is_correct' => false],
                    ['text' => 'مصر', 'is_correct' => false],
                ],
            ],

            // 6 — ثقافة عامة
            [
                'question' => 'كم عدد أضلاع الشكل السداسي؟',
                'answers' => [
                    ['text' => 'ثمانية', 'is_correct' => false],
                    ['text' => 'ستة', 'is_correct' => true],
                    ['text' => 'سبعة', 'is_correct' => false],
                    ['text' => 'خمسة', 'is_correct' => false],
                ],
            ],

            // 7 — ثقافة عامة
            [
                'question' => 'من رسم لوحة ليلة النجوم؟',
                'answers' => [
                    ['text' => 'ليوناردو دا فينشي', 'is_correct' => false],
                    ['text' => 'بابلو بيكاسو', 'is_correct' => false],
                    ['text' => 'كلود مونيه', 'is_correct' => false],
                    ['text' => 'فنسنت فان غوخ', 'is_correct' => true],
                ],
            ],

            // 8 — ثقافة عامة
            [
                'question' => 'ما عاصمة كندا؟',
                'answers' => [
                    ['text' => 'مونتريال', 'is_correct' => false],
                    ['text' => 'فانكوفر', 'is_correct' => false],
                    ['text' => 'تورونتو', 'is_correct' => false],
                    ['text' => 'أوتاوا', 'is_correct' => true],
                ],
            ],

            // 9 — ثقافة عامة
            [
                'question' => 'ما الكوكب الذي يُعرف بالكوكب الأحمر؟',
                'answers' => [
                    ['text' => 'المريخ', 'is_correct' => true],
                    ['text' => 'عطارد', 'is_correct' => false],
                    ['text' => 'الزهرة', 'is_correct' => false],
                    ['text' => 'زحل', 'is_correct' => false],
                ],
            ],

            // 10 — ثقافة عامة
            [
                'question' => 'أي عالم صاغ قوانين الحركة الثلاثة؟',
                'answers' => [
                    ['text' => 'مايكل فاراداي', 'is_correct' => false],
                    ['text' => 'غاليليو غاليلي', 'is_correct' => false],
                    ['text' => 'إسحاق نيوتن', 'is_correct' => true],
                    ['text' => 'ألبرت أينشتاين', 'is_correct' => false],
                ],
            ],

            // 11 — ثقافة عامة
            [
                'question' => 'في أي قارة تقع دولة سورينام؟',
                'answers' => [
                    ['text' => 'أوروبا', 'is_correct' => false],
                    ['text' => 'آسيا', 'is_correct' => false],
                    ['text' => 'إفريقيا', 'is_correct' => false],
                    ['text' => 'أمريكا الجنوبية', 'is_correct' => true],
                ],
            ],

            // 12 — ثقافة عامة
            [
                'question' => 'ما العضو الذي ينتج الأنسولين في جسم الإنسان؟',
                'answers' => [
                    ['text' => 'الكبد', 'is_correct' => false],
                    ['text' => 'الطحال', 'is_correct' => false],
                    ['text' => 'البنكرياس', 'is_correct' => true],
                    ['text' => 'الكلى', 'is_correct' => false],
                ],
            ],

            // 13 — ثقافة عامة
            [
                'question' => 'أي مدينة تُلقب بمدينة القنوات وتضم ساحة سان ماركو؟',
                'answers' => [
                    ['text' => 'نابولي', 'is_correct' => false],
                    ['text' => 'البندقية', 'is_correct' => true],
                    ['text' => 'فلورنسا', 'is_correct' => false],
                    ['text' => 'ميلانو', 'is_correct' => false],
                ],
            ],

            // 14 — ثقافة عامة
            [
                'question' => 'من مؤلف مسرحية هاملت؟',
                'answers' => [
                    ['text' => 'تشارلز ديكنز', 'is_correct' => false],
                    ['text' => 'جورج برنارد شو', 'is_correct' => false],
                    ['text' => 'أوسكار وايلد', 'is_correct' => false],
                    ['text' => 'ويليام شكسبير', 'is_correct' => true],
                ],
            ],

            // 15 — ثقافة عامة
            [
                'question' => 'ما اسم العملة الرسمية في اليابان؟',
                'answers' => [
                    ['text' => 'الروبية', 'is_correct' => false],
                    ['text' => 'الين', 'is_correct' => true],
                    ['text' => 'اليوان', 'is_correct' => false],
                    ['text' => 'الوون', 'is_correct' => false],
                ],
            ],

            // 16 — ثقافة عامة
            [
                'question' => 'ما الغاز الذي يشكّل النسبة الأكبر من الغلاف الجوي للأرض؟',
                'answers' => [
                    ['text' => 'الأكسجين', 'is_correct' => false],
                    ['text' => 'النيتروجين', 'is_correct' => true],
                    ['text' => 'ثاني أكسيد الكربون', 'is_correct' => false],
                    ['text' => 'الهيدروجين', 'is_correct' => false],
                ],
            ],

            // 17 — ثقافة عامة
            [
                'question' => 'أي دولة إفريقية كانت تُعرف سابقًا باسم الحبشة؟',
                'answers' => [
                    ['text' => 'السودان', 'is_correct' => false],
                    ['text' => 'إريتريا', 'is_correct' => false],
                    ['text' => 'إثيوبيا', 'is_correct' => true],
                    ['text' => 'الصومال', 'is_correct' => false],
                ],
            ],

            // 18 — ثقافة عامة
            [
                'question' => 'أي محيط يقع بين إفريقيا وأستراليا؟',
                'answers' => [
                    ['text' => 'المحيط الهندي', 'is_correct' => true],
                    ['text' => 'المحيط المتجمد الشمالي', 'is_correct' => false],
                    ['text' => 'المحيط الهادئ', 'is_correct' => false],
                    ['text' => 'المحيط الأطلسي', 'is_correct' => false],
                ],
            ],

            // 19 — ثقافة عامة
            [
                'question' => 'من أول إنسان سار على سطح القمر؟',
                'answers' => [
                    ['text' => 'باز ألدرين', 'is_correct' => false],
                    ['text' => 'نيل أرمسترونغ', 'is_correct' => true],
                    ['text' => 'مايكل كولينز', 'is_correct' => false],
                    ['text' => 'يوري غاغارين', 'is_correct' => false],
                ],
            ],

            // 20 — ثقافة عامة
            [
                'question' => 'ما اسم الوحدة الأساسية لقياس شدة التيار الكهربائي؟',
                'answers' => [
                    ['text' => 'الواط', 'is_correct' => false],
                    ['text' => 'الأوم', 'is_correct' => false],
                    ['text' => 'الأمبير', 'is_correct' => true],
                    ['text' => 'الفولت', 'is_correct' => false],
                ],
            ],

            // 21 — ثقافة عامة
            [
                'question' => 'في أي سنة بدأت الحرب العالمية الأولى؟',
                'answers' => [
                    ['text' => '1918', 'is_correct' => false],
                    ['text' => '1905', 'is_correct' => false],
                    ['text' => '1939', 'is_correct' => false],
                    ['text' => '1914', 'is_correct' => true],
                ],
            ],

            // 22 — ثقافة عامة
            [
                'question' => 'ما الدولة التي يوجد فيها معبد أنغكور وات؟',
                'answers' => [
                    ['text' => 'لاوس', 'is_correct' => false],
                    ['text' => 'تايلاند', 'is_correct' => false],
                    ['text' => 'كمبوديا', 'is_correct' => true],
                    ['text' => 'فيتنام', 'is_correct' => false],
                ],
            ],

            // 23 — ثقافة عامة
            [
                'question' => 'ما أكبر عضو في جسم الإنسان من حيث المساحة؟',
                'answers' => [
                    ['text' => 'الرئتان', 'is_correct' => false],
                    ['text' => 'الجلد', 'is_correct' => true],
                    ['text' => 'الكبد', 'is_correct' => false],
                    ['text' => 'القلب', 'is_correct' => false],
                ],
            ],

            // 24 — ثقافة عامة
            [
                'question' => 'من اكتشف البنسلين؟',
                'answers' => [
                    ['text' => 'لويس باستور', 'is_correct' => false],
                    ['text' => 'ماري كوري', 'is_correct' => false],
                    ['text' => 'ألكسندر فليمنغ', 'is_correct' => true],
                    ['text' => 'روبرت كوخ', 'is_correct' => false],
                ],
            ],

            // 25 — ثقافة عامة
            [
                'question' => 'ما عاصمة نيوزيلندا؟',
                'answers' => [
                    ['text' => 'أوكلاند', 'is_correct' => false],
                    ['text' => 'هاميلتون', 'is_correct' => false],
                    ['text' => 'ويلينغتون', 'is_correct' => true],
                    ['text' => 'كرايستشيرش', 'is_correct' => false],
                ],
            ],

            // 26 — كرة القدم
            [
                'question' => 'أي منتخب فاز بكأس العالم سنة 2010؟',
                'answers' => [
                    ['text' => 'إسبانيا', 'is_correct' => true],
                    ['text' => 'هولندا', 'is_correct' => false],
                    ['text' => 'ألمانيا', 'is_correct' => false],
                    ['text' => 'البرازيل', 'is_correct' => false],
                ],
            ],

            // 27 — كرة القدم
            [
                'question' => 'من سجّل هدف الفوز لإسبانيا في نهائي كأس العالم 2010؟',
                'answers' => [
                    ['text' => 'تشافي هيرنانديز', 'is_correct' => false],
                    ['text' => 'أندريس إنييستا', 'is_correct' => true],
                    ['text' => 'دافيد فيا', 'is_correct' => false],
                    ['text' => 'فرناندو توريس', 'is_correct' => false],
                ],
            ],

            // 28 — كرة القدم
            [
                'question' => 'أي نادٍ فاز بدوري أبطال أوروبا سنة 2012؟',
                'answers' => [
                    ['text' => 'برشلونة', 'is_correct' => false],
                    ['text' => 'تشيلسي', 'is_correct' => true],
                    ['text' => 'مانشستر يونايتد', 'is_correct' => false],
                    ['text' => 'بايرن ميونخ', 'is_correct' => false],
                ],
            ],

            // 29 — كرة القدم
            [
                'question' => 'أمام أي منتخب سجّل زين الدين زيدان هدفين في نهائي كأس العالم 1998؟',
                'answers' => [
                    ['text' => 'إيطاليا', 'is_correct' => false],
                    ['text' => 'البرازيل', 'is_correct' => true],
                    ['text' => 'ألمانيا', 'is_correct' => false],
                    ['text' => 'الأرجنتين', 'is_correct' => false],
                ],
            ],

            // 30 — كرة القدم
            [
                'question' => 'من اللاعب الذي يُعرف بلقب الظاهرة (R9)؟',
                'answers' => [
                    ['text' => 'كريستيانو رونالدو', 'is_correct' => false],
                    ['text' => 'رونالدو نازاريو', 'is_correct' => true],
                    ['text' => 'رونالدينيو', 'is_correct' => false],
                    ['text' => 'ريفالدو', 'is_correct' => false],
                ],
            ],

            // 31 — كرة القدم
            [
                'question' => 'أي فريق إيطالي يُلقب بالسيدة العجوز؟',
                'answers' => [
                    ['text' => 'إنتر ميلان', 'is_correct' => false],
                    ['text' => 'روما', 'is_correct' => false],
                    ['text' => 'يوفنتوس', 'is_correct' => true],
                    ['text' => 'ميلان', 'is_correct' => false],
                ],
            ],

            // 32 — كرة القدم
            [
                'question' => 'أي منتخب إفريقي بلغ نصف نهائي كأس العالم 2022؟',
                'answers' => [
                    ['text' => 'غانا', 'is_correct' => false],
                    ['text' => 'المغرب', 'is_correct' => true],
                    ['text' => 'السنغال', 'is_correct' => false],
                    ['text' => 'الكاميرون', 'is_correct' => false],
                ],
            ],

            // 33 — كرة القدم
            [
                'question' => 'من فاز بالكرة الذهبية سنة 2007؟',
                'answers' => [
                    ['text' => 'رونالدينيو', 'is_correct' => false],
                    ['text' => 'ليونيل ميسي', 'is_correct' => false],
                    ['text' => 'كريستيانو رونالدو', 'is_correct' => false],
                    ['text' => 'كاكا', 'is_correct' => true],
                ],
            ],

            // 34 — كرة القدم
            [
                'question' => 'أي نادٍ كان يلعب له محمد صلاح قبل انتقاله إلى ليفربول سنة 2017؟',
                'answers' => [
                    ['text' => 'تشيلسي', 'is_correct' => false],
                    ['text' => 'فيورنتينا', 'is_correct' => false],
                    ['text' => 'نابولي', 'is_correct' => false],
                    ['text' => 'روما', 'is_correct' => true],
                ],
            ],

            // 35 — كرة القدم
            [
                'question' => 'ما النادي الذي فاز بدوري أبطال أوروبا سنة 2004 بقيادة جوزيه مورينيو؟',
                'answers' => [
                    ['text' => 'بورتو', 'is_correct' => true],
                    ['text' => 'إنتر ميلان', 'is_correct' => false],
                    ['text' => 'بنفيكا', 'is_correct' => false],
                    ['text' => 'تشيلسي', 'is_correct' => false],
                ],
            ],

            // 36 — كرة القدم
            [
                'question' => 'أي منتخب فاز بكأس أمم أوروبا 2016؟',
                'answers' => [
                    ['text' => 'فرنسا', 'is_correct' => false],
                    ['text' => 'إسبانيا', 'is_correct' => false],
                    ['text' => 'إيطاليا', 'is_correct' => false],
                    ['text' => 'البرتغال', 'is_correct' => true],
                ],
            ],

            // 37 — كرة القدم
            [
                'question' => 'من سجّل هدف الفوز للبرتغال في نهائي يورو 2016؟',
                'answers' => [
                    ['text' => 'كريستيانو رونالدو', 'is_correct' => false],
                    ['text' => 'إيدر', 'is_correct' => true],
                    ['text' => 'ريكاردو كواريزما', 'is_correct' => false],
                    ['text' => 'ناني', 'is_correct' => false],
                ],
            ],

            // 38 — كرة القدم
            [
                'question' => 'من هداف كأس العالم 2014 بستة أهداف؟',
                'answers' => [
                    ['text' => 'خاميس رودريغيز', 'is_correct' => true],
                    ['text' => 'توماس مولر', 'is_correct' => false],
                    ['text' => 'نيمار', 'is_correct' => false],
                    ['text' => 'ليونيل ميسي', 'is_correct' => false],
                ],
            ],

            // 39 — كرة القدم
            [
                'question' => 'أي نادٍ فاز بالدوري الإنجليزي الممتاز موسم 2015-2016؟',
                'answers' => [
                    ['text' => 'ليستر سيتي', 'is_correct' => true],
                    ['text' => 'أرسنال', 'is_correct' => false],
                    ['text' => 'تشيلسي', 'is_correct' => false],
                    ['text' => 'مانشستر سيتي', 'is_correct' => false],
                ],
            ],

            // 40 — كرة القدم
            [
                'question' => 'في أي ملعب يخوض بوروسيا دورتموند مبارياته البيتية؟',
                'answers' => [
                    ['text' => 'أليانز أرينا', 'is_correct' => false],
                    ['text' => 'فيلتينس أرينا', 'is_correct' => false],
                    ['text' => 'سيغنال إيدونا بارك', 'is_correct' => true],
                    ['text' => 'باي أرينا', 'is_correct' => false],
                ],
            ],

            // 41 — كرة القدم
            [
                'question' => 'أي فريق انتقل إليه لويس سواريز من ليفربول سنة 2014؟',
                'answers' => [
                    ['text' => 'برشلونة', 'is_correct' => true],
                    ['text' => 'بايرن ميونخ', 'is_correct' => false],
                    ['text' => 'ريال مدريد', 'is_correct' => false],
                    ['text' => 'أتلتيكو مدريد', 'is_correct' => false],
                ],
            ],

            // 42 — كرة القدم
            [
                'question' => 'أي منتخب فاز بكأس العالم سنة 2006؟',
                'answers' => [
                    ['text' => 'ألمانيا', 'is_correct' => false],
                    ['text' => 'إيطاليا', 'is_correct' => true],
                    ['text' => 'البرازيل', 'is_correct' => false],
                    ['text' => 'فرنسا', 'is_correct' => false],
                ],
            ],

            // 43 — كرة القدم
            [
                'question' => 'من حارس المرمى الذي تصدى لركلة جزاء أريين روبن في نهائي دوري الأبطال 2012 أثناء الوقت الإضافي؟',
                'answers' => [
                    ['text' => 'جيانلويجي بوفون', 'is_correct' => false],
                    ['text' => 'إيكر كاسياس', 'is_correct' => false],
                    ['text' => 'بيتر تشيك', 'is_correct' => true],
                    ['text' => 'مانويل نوير', 'is_correct' => false],
                ],
            ],

            // 44 — كرة القدم
            [
                'question' => 'أي نادٍ حقق الثلاثية (الدوري والكأس ودوري الأبطال) سنة 2010؟',
                'answers' => [
                    ['text' => 'ميلان', 'is_correct' => false],
                    ['text' => 'يوفنتوس', 'is_correct' => false],
                    ['text' => 'إنتر ميلان', 'is_correct' => true],
                    ['text' => 'روما', 'is_correct' => false],
                ],
            ],

            // 45 — كرة القدم
            [
                'question' => 'ما المنتخب الذي فاز بكوبا أمريكا 2021؟',
                'answers' => [
                    ['text' => 'تشيلي', 'is_correct' => false],
                    ['text' => 'الأرجنتين', 'is_correct' => true],
                    ['text' => 'أوروغواي', 'is_correct' => false],
                    ['text' => 'البرازيل', 'is_correct' => false],
                ],
            ],

            // 46 — كرة القدم
            [
                'question' => 'أي نادٍ كان أول من لعب له كيليان مبابي في دوري الدرجة الأولى الفرنسي؟',
                'answers' => [
                    ['text' => 'موناكو', 'is_correct' => true],
                    ['text' => 'ليون', 'is_correct' => false],
                    ['text' => 'ليل', 'is_correct' => false],
                    ['text' => 'باريس سان جيرمان', 'is_correct' => false],
                ],
            ],

            // 47 — كرة القدم
            [
                'question' => 'من مدرب منتخب فرنسا عند فوزه بكأس العالم 2018؟',
                'answers' => [
                    ['text' => 'أرسين فينغر', 'is_correct' => false],
                    ['text' => 'ديدييه ديشان', 'is_correct' => true],
                    ['text' => 'لوران بلان', 'is_correct' => false],
                    ['text' => 'زين الدين زيدان', 'is_correct' => false],
                ],
            ],

            // 48 — كرة القدم
            [
                'question' => 'أي لاعب سجل هدف المقصية الشهير لريال مدريد أمام يوفنتوس في دوري أبطال أوروبا 2018؟',
                'answers' => [
                    ['text' => 'غاريث بيل', 'is_correct' => false],
                    ['text' => 'ماركو أسينسيو', 'is_correct' => false],
                    ['text' => 'كريم بنزيما', 'is_correct' => false],
                    ['text' => 'كريستيانو رونالدو', 'is_correct' => true],
                ],
            ],

            // 49 — كرة القدم
            [
                'question' => 'ما النادي الذي فاز بدوري أبطال أوروبا 2019؟',
                'answers' => [
                    ['text' => 'ليفربول', 'is_correct' => true],
                    ['text' => 'برشلونة', 'is_correct' => false],
                    ['text' => 'أياكس', 'is_correct' => false],
                    ['text' => 'توتنهام', 'is_correct' => false],
                ],
            ],

            // 50 — كرة القدم
            [
                'question' => 'كم نقطة يحصل عليها الفريق مقابل الفوز في مباراة بالدوري بنظام النقاط المعتاد؟',
                'answers' => [
                    ['text' => '4 نقاط', 'is_correct' => false],
                    ['text' => 'نقطة واحدة', 'is_correct' => false],
                    ['text' => '3 نقاط', 'is_correct' => true],
                    ['text' => 'نقطتان', 'is_correct' => false],
                ],
            ],

        ];

        foreach ($questions as $q) {
            $question = Question::create([
                'question_text' => $q['question'],
            ]);

            foreach ($q['answers'] as $a) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $a['text'],
                    'is_correct' => $a['is_correct'],
                ]);
            }
        }
    }
}
