const reset_filter = {

   resetBtn: document.getElementById('reset_btn'),

   init: function() {
        reset_filter.resetBtn.addEventListener('click', reset_filter.handleResetFilter)
   },

   /**
    * Handler to reset filter menu once it's validated
    */
   handleResetFilter: function(){
        // electricityLevel
        const electricityLevel1 = document.getElementById('filter_data_electricityLevel_1');
        if(electricityLevel1.hasAttribute("checked")) {
            electricityLevel1.removeAttribute("checked");
        };
        const electricityLevel2 = document.getElementById('filter_data_electricityLevel_2');
        if(electricityLevel2.hasAttribute("checked")) {
        electricityLevel2.removeAttribute("checked");
        }
        const electricityLevel3 = document.getElementById('filter_data_electricityLevel_3');
        if(electricityLevel3.hasAttribute("checked")) {
            electricityLevel3.removeAttribute("checked");
        }
        // internetLevel
        const internetLevel1 = document.getElementById('filter_data_internetLevel_1');
        if(internetLevel1.hasAttribute("checked")) {
            internetLevel1.removeAttribute("checked");
        }
        const internetLevel2 = document.getElementById('filter_data_internetLevel_2');
        if(internetLevel2.hasAttribute("checked")) {
            internetLevel2.removeAttribute("checked");
        }
        const internetLevel3 = document.getElementById('filter_data_internetLevel_3');
        if(internetLevel3.hasAttribute("checked")) {
            internetLevel3.removeAttribute("checked");
        }
        // sunshineLevel
        const sunshineLevel1 = document.getElementById('filter_data_sunshineLevel_1');
        if(sunshineLevel1.hasAttribute("checked")) {
            sunshineLevel1.removeAttribute("checked");
        }
        const sunshineLevel2 = document.getElementById('filter_data_sunshineLevel_2');
        if(sunshineLevel2.hasAttribute("checked")) {
            sunshineLevel2.removeAttribute("checked");
        }
        const sunshineLevel3 = document.getElementById('filter_data_sunshineLevel_3');
        if(sunshineLevel3.hasAttribute("checked")) {
            sunshineLevel3.removeAttribute("checked");
        }
        // housingLevel
        const housingLevel1 = document.getElementById('filter_data_housingLevel_1');
        if(housingLevel1.hasAttribute("checked")) {
            housingLevel1.removeAttribute("checked");
        }
        const housingLevel2 = document.getElementById('filter_data_housingLevel_2');
        if(housingLevel2.hasAttribute("checked")) {
            housingLevel2.removeAttribute("checked");
        }
        const housingLevel3 = document.getElementById('filter_data_housingLevel_3');
        if(housingLevel3.hasAttribute("checked")) {
            housingLevel3.removeAttribute("checked");
        }
        // temperatureAverage
        const temperatureAverageMin = document.getElementById('filter_data_temperatureMin');
        if(temperatureAverageMin.hasAttribute("value")) {
            temperatureAverageMin.removeAttribute("value");
        }
        const temperatureAverageMax = document.getElementById('filter_data_temperatureMax');
        if(temperatureAverageMax.hasAttribute("value")) {
            temperatureAverageMax.removeAttribute("value");
        }
        // demography
        const demographyMin = document.getElementById('filter_data_demographyMin');
        if(demographyMin.hasAttribute("value")) {
            demographyMin.removeAttribute("value");
        }
        const demographyMax = document.getElementById('filter_data_demographyMax');
        if(demographyMax.hasAttribute("value")) {
            demographyMax.removeAttribute("value");
        }
        // lifeCost
        const lifeCostMin = document.getElementById('filter_data_costMin');
        if(lifeCostMin.hasAttribute("value")) {
            lifeCostMin.removeAttribute("value");
        }
        const lifeCostMax = document.getElementById('filter_data_costMax');
        if(lifeCostMax.hasAttribute("value")) {
            lifeCostMax.removeAttribute("value");
        }
        // area
        const areaMin = document.getElementById('filter_data_areaMin');
        if(areaMin.hasAttribute("value")) {
            areaMin.removeAttribute("value");
        }
        const areaMax = document.getElementById('filter_data_areaMax');
        if(areaMax.hasAttribute("value")) {
            areaMax.removeAttribute("value");
        }
        // currencyType
        const currencyType = document.getElementById('filter_data_currencyType');
        const optionsCurrency = currencyType.getElementsByTagName('option');
        for (let i = 0; i < optionsCurrency.length; i++) {
            if (optionsCurrency[i].hasAttribute('selected')) {
                optionsCurrency[i].removeAttribute('selected');
                break;
            }
        }
        // timezone
        const timezone = document.getElementById('filter_data_timezone');
        if(timezone.hasAttribute("value")) {
            timezone.removeAttribute("value");
        }
        // language
        const language = document.getElementById('filter_data_language');
        const optionsLanguage = language.getElementsByTagName('option');
        for (let i = 0; i < optionsLanguage.length; i++) {
            if (optionsLanguage[i].hasAttribute('selected')) {
                optionsLanguage[i].removeAttribute('selected');
                break;
            }
        }
        // visaType
        const visaType0 = document.getElementById('filter_data_visaType_0');
        if(visaType0.hasAttribute("checked")) {
            visaType0.removeAttribute("checked");
        };
        const visaType1 = document.getElementById('filter_data_visaType_1');
        if(visaType1.hasAttribute("checked")) {
            visaType1.removeAttribute("checked");
        };
        const visaType2 = document.getElementById('filter_data_visaType_2');
        if(visaType2.hasAttribute("checked")) {
            visaType2.removeAttribute("checked");
        }
        const visaType3 = document.getElementById('filter_data_visaType_3');
        if(visaType3.hasAttribute("checked")) {
            visaType3.removeAttribute("checked");
        }
        const visaType4 = document.getElementById('filter_data_visaType_4');
        if(visaType4.hasAttribute("checked")) {
            visaType4.removeAttribute("checked");
        };
        const visaType5 = document.getElementById('filter_data_visaType_5');
        if(visaType5.hasAttribute("checked")) {
            visaType5.removeAttribute("checked");
        };
        const visaType6 = document.getElementById('filter_data_visaType_6');
        if(visaType6.hasAttribute("checked")) {
            visaType6.removeAttribute("checked");
        }
        const visaType7 = document.getElementById('filter_data_visaType_7');
        if(visaType7.hasAttribute("checked")) {
            visaType7.removeAttribute("checked");
        }
        const visaType8 = document.getElementById('filter_data_visaType_8');
        if(visaType8.hasAttribute("checked")) {
            visaType8.removeAttribute("checked");
        }
        const visaType9 = document.getElementById('filter_data_visaType_9');
        if(visaType9.hasAttribute("checked")) {
            visaType9.removeAttribute("checked");
        };
        const visaType10 = document.getElementById('filter_data_visaType_10');
        if(visaType10.hasAttribute("checked")) {
            visaType10.removeAttribute("checked");
        };
        const visaType11 = document.getElementById('filter_data_visaType_11');
        if(visaType11.hasAttribute("checked")) {
            visaType11.removeAttribute("checked");
        }
        // visaRequired
        const visaRequired = document.getElementById('filter_data_visaRequired');
        if(visaRequired.hasAttribute("checked")) {
            visaRequired.removeAttribute("checked");
        }
        // environment
        const environment0 = document.getElementById('filter_data_environment_0');
        if(environment0.hasAttribute("checked")) {
            environment0.removeAttribute("checked");
        }
        const environment1 = document.getElementById('filter_data_environment_1');
        if(environment1.hasAttribute("checked")) {
            environment1.removeAttribute("checked");
        };
        const environment2 = document.getElementById('filter_data_environment_2');
        if(environment2.hasAttribute("checked")) {
            environment2.removeAttribute("checked");
        };
        const environment3 = document.getElementById('filter_data_environment_3');
        if(environment3.hasAttribute("checked")) {
            environment3.removeAttribute("checked");
        }
   }
}

document.addEventListener('DOMContentLoaded', reset_filter.init)
