<template>
  <section>
    <Loading v-if="loading" />

    <div v-else>
      <div class="content-header">
        <h1>Omstilling</h1>
      </div>

      <table class="table">
        <thead>
          <tr>
            <th width="150">Redirect nøgle</th>
            <th>URL</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="redirect in input" :key="redirect.id">
            <td>{{ redirect.name }}</td>
            <td>
              <input
                type="text"
                v-model="redirect.url"
                class="form-control"
              />
            </td>
          </tr>
        </tbody>
      </table>

      <v-btn color="primary" @click="update" :loading="submitLoading">
        Opdater
      </v-btn>
      <v-btn @click="goto('settings.index')">Annuller</v-btn>
    </div>
  </section>
</template>

<script>
import TableEdit from "@/Mixins/TableEdit";

export default {
  mixins: [TableEdit],

  data() {
    return {
      loading: true,
      submitLoading: false,
      input: [], // forventer array med redirects
    };
  },

  methods: {
    async get() {
      this.loading = true;
      try {
        const res = await axios.get(route("api.redirects.redirect.index"));
        this.input = res.data.data; // array med redirects
      } catch (error) {
        console.error(error);
      } finally {
        this.loading = false;
      }
    },

    async update() {
      this.submitLoading = true;

      // Omform input-array til ønsket format
      const resources = {};
      this.input.forEach((redirect) => {
        resources[redirect.id] = {
          title: redirect.name,  // hvis du også skal sende title - ellers fjern denne linje
          url: redirect.url,
        };
      });

      try {
        // Send data som { resources: {id: {...}, id2: {...} } }
        const res = await axios.patch(route("api.redirects.redirect.batchUpdate"), { resources });
        console.log("Batch opdateret", res.data);
        // this.$router.push({ name: "settings.index" })  // evt. redirect
      } catch (error) {
        console.error("Fejl ved opdatering:", error);
      } finally {
        this.submitLoading = false;
      }
    },
  },

  mounted() {
    this.get();
  },
};
</script>

<style scoped>
/* evt. styling her */
</style>
