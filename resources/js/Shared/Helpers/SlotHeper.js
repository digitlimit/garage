import { useSlot } from '@/Store/slot';

export default {
 
    async disabledDates() 
    {
        const slot = useSlot();
        
        const closedDates = await slot.closedDates();

        return closedDates.map(item => new Date(item.date));
    },

    async selectOptions(prefixLabel)
    {
        const slot = useSlot();
        const options = await slot.slots();

        options.forEach((slot, index) => {
            options[index] = {label: slot.name, value: slot.id}
        });

        if(prefixLabel) {
            return prefixLabel.concat(options);
        }

        const newOptions = [{label: "Not applicable", value: null}]
            .concat(options);
        
        return newOptions;
    }
}